<?php

namespace App\Policies;

use App\Admin;
use App\Admin\Company\Company;
use App\Admin\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ( $this->checkPermission($user , config('permissions.PERMISSION_TASKS_APPROVAL')) ){
            return true;
        }
    }

    public function view(Admin $user, Company $company)
    {
        //
    }

    public function create(Admin $user)
    {
        //
    }

    public function updateCompanies(Admin $user, Company $company)
    {
        if($this->checkPermission($user , config('permissions.PERMISSION_EDIT_COMPANIES'))){
            return $company->real == 'N' ? true : false;
        }
        return false;
    }

    public function deleteCompanies(Admin $user, Company $company )
    {
        if($this->checkPermission($user , config('permissions.PERMISSION_DELETE_COMPANIES'))){
            return $company->real == 'N' ? true : false;
        }
        return false;
    }
}
