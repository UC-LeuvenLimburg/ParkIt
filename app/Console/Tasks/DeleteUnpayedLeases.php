<?php

namespace App\Console\Commands;

use App\Repositories\Interfaces\ILeaseRepository;

class DeleteUnpayedLeases
{
    private $leaseRepo;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(ILeaseRepository $leaseRepo)
    {
        $this->leaseRepo = $leaseRepo;
        parent::__construct();
    }

    /**
     * run the deleteUnpayedLease Task
     *
     * @return void
     */
    public function __invoke()
    {
        $this->leaseRepo->deleteUnpayedLease();
    }
}
