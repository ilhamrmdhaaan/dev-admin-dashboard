<?php

namespace App\Interfaces\Dashboard;

interface DashboardInterface
{
    public function totalRequest();
    public function totalStatusApproved();
    public function totalStatusPending();
    public function totalStatusCancel();
}
