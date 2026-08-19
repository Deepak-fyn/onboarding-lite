<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $agent = $request->user();

        $menu = [];

        if ($agent->can('view agents')) {
            $menu[] = [
                'name' => 'Agents',
                'permission' => 'view agents',
            ];
        }

        if ($agent->can('view documents')) {
            $menu[] = [
                'name' => 'Documents',
                'permission' => 'view documents',
            ];
        }

        if ($agent->can('upload documents')) {
            $menu[] = [
                'name' => 'Upload Documents',
                'permission' => 'upload documents',
            ];
        }

        if ($agent->hasRole('SuperAdmin')) {
            $menu[] = [
                'name' => 'Role Management',
                'permission' => 'SuperAdmin',
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $menu,
        ]);
    }
}