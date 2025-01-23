<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReactAdminResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(['perPage' => 10]);
        if($request->filled('_start')) {
            if($request->filled('_end')) {
                $request->merge(['perPage' => 1 + $request->_end - $request->_start]);
            }
            $request->merge(['page' => intval($request->_start / $request->perPage) + 1]);
        }

          $response = $next($request);

        if($request->routeIs('*.index')) {
            abort_unless(property_exists($request->route()->controller, 'modelclass'), 500, "It must exists a modelclass property in the controller.");
            $modelClassName = $request->route()->controller->modelclass;
            $response->header('X-Total-Count',$modelClassName::count());

            if($request->filled('q')) {
                $filterColumns = $modelClassName::$filterColumns;
                $query = $this->applyFilter($request, $filterColumns);
                $response->setData($query->paginate($request->perPage));
            }

            if($request->filled('_sort')) {
                $query = $this->applySort($request, $query ?? $modelClassName::query());
                $response->setData($query->paginate($request->perPage));
            }

        }
        try {

            if(is_callable([$response, 'getData'])) {
                $responseData = $response->getData();
                if(isset($responseData->data)) {
                    $response->setData($responseData->data);
                }
            }
        } catch (\Throwable $th) { }
        return $response;
    }

    public function applyFilter($request, $filterColumns)
    {
        $modelClassName = $request->route()->controller->modelclass;
        $query = $modelClassName::query();

        $filterValue = $request->q;

        if ($filterValue) {
            $query->where(function ($query) use ($filterValue, $filterColumns) {
                foreach ($filterColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $filterValue . '%');
                }
            });
        }
        return $query;
    }

    public function applySort($request, $query)
    {
        $sort = $request->_sort;
        $order = $request->_order;

        if ($sort && $order) {
            $query->orderBy($sort, $order);
        }

        return $query;
    }
}
