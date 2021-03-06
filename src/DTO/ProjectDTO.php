<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Company;
use App\Entity\Customer;
use Symfony\Component\Validator\Constraints as Assert;

class ProjectDTO
{
    /**
     * @var Company|null
     *
     * @Assert\NotNull()
     */
    public $company;

    /**
     * @var Customer|null
     *
     * @Assert\NotNull()
     */
    public $customer;

    /**
     * @var int|null
     *
     * @Assert\NotBlank()
     */
    public $projectNumber;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var float|null
     */
    public $budget;

    /**
     * @var float|null
     */
    public $pricePerHour;

    /**
     * @var float|null
     */
    public $budgetBilled;
}
