<?php

use App\Support\Enums\CategoryRequestStatus;
use App\Support\Enums\JobStatus;
use App\Support\Enums\ProposalStatus;
use App\Support\Enums\ReviewType;
use App\Support\Enums\UserType;

return [

    /*
    |--------------------------------------------------------------------------
    | Enums Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by application enums
    |
    */
    'user_type' => [
        UserType::Client->name => 'Client',
        UserType::Worker->name => 'Worker',
    ],
    'job_status' => [
        JobStatus::Pending->name => 'Pending',
        JobStatus::Booked->name => 'Booked',
        JobStatus::Canceled->name => 'Canceled',
        JobStatus::Finished->name => 'Finished',
    ],
    'proposal_status' => [
        ProposalStatus::Pending->name => 'Pending',
        ProposalStatus::Accepted->name => 'Accepted',
        ProposalStatus::Rejected->name => 'Rejected',
    ],
    'review_type' => [
        ReviewType::Client->name => 'Client',
        ReviewType::Worker->name => 'Worker',
    ],
    'category_request' => [
        CategoryRequestStatus::Pending->name => 'Pending',
        CategoryRequestStatus::Accepted->name => 'Accepted',
        CategoryRequestStatus::Rejected->name => 'Rejected',
    ],
];
