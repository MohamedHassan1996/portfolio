<?php


namespace App\Services\Select;

use App\Services\Select\Company\BranchSelectService;
use App\Services\Select\Company\CompanySelectService;
use App\Services\Select\Company\CustomerSelectService;
use App\Services\Select\Parameter\ParameterSelectService;

class SelectService
{
    public function getSelects(String $selects)
    {
        $selectsArr = explode(',', $selects);
        $selectData = [];

        foreach ($selectsArr as $select) {
            $selectServiceData = $this->resolveSelectService($select);

            if ($selectServiceData) {
                [$method, $selectServiceClass, $paramValue] = $selectServiceData;

                $selectService = new $selectServiceClass(); // Instantiate the service class
                if (isset($paramValue)) {
                    $selectData[] = [
                        'label' => explode("=", $select)[0],
                        'options' => $selectService->$method($paramValue)
                    ];
                } else {
                    $selectData[] = [
                        'label' => $select,
                        'options' => $selectService->$method()
                    ];
                }
            }
        }

        return $selectData;
    }

    private function resolveSelectService($select)
    {
        $selectServiceMap = [
            'users' => ['getAllUsers', UserSelectService::class],
            'roles' => ['getAllRoles', RoleSelectService::class],
            'permissions' => ['getAllPermissions', PermissionSelectService::class],
            'blogCategories' => ['getAllBlogCategories', BlogCategorySelectService::class],
            //'parameters' => ['getAllParameters', ParameterSelectService::class]
        ];

        $paramValue = null; // Initialize paramValue

        // Check if parameter is provided directly
        if (preg_match('/(\w+)=(\d+)/', $select, $matches)) {
            $select = $matches[1];
            $paramValue = (int)$matches[2];
        }

        if (array_key_exists($select, $selectServiceMap)) {
            $serviceData = $selectServiceMap[$select];
            // Ensure $paramValue is set as the third element
            $serviceData[] = $paramValue;
            return $serviceData;
        }

        // If no matching service is found, you can handle it accordingly (e.g., return null or throw an exception)
        return null;
    }

}
