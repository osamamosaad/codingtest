<?php declare(strict_types=1);

namespace Tests\Machine;

use App\Machine\ChangeCalculator;
use App\Machine\CigaretteMachine;
use App\Machine\Exceptions\InvalidAmount;
use App\Machine\Exceptions\InvalidQuantity;
use PHPUnit\Framework\TestCase;

class TestMachine extends TestCase
{


    public function testCannotProcessAmountLessThanTheTotalPrice(): void
    {
        $machine = new CigaretteMachine(new ChangeCalculator());
        $this->expectException(InvalidAmount::class);
        $machine->execute(new TestPurchaseTransaction(4, 19.95)); // 4 items = 19.96
    }

    public function testCannotProcessQuantityLessThanOne(): void
    {
        $machine = new CigaretteMachine(new ChangeCalculator());
        $this->expectException(InvalidQuantity::class);
        $machine->execute(new TestPurchaseTransaction(0, 10.00)); 
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMachinReturnTheExpectedResults($quantity, $amount, $result): void
    {
        $machine = new CigaretteMachine(new ChangeCalculator());
        $purchased = $machine->execute(new TestPurchaseTransaction($quantity, $amount));
        $this->assertEqualsCanonicalizing($result, $purchased->getChange());
    }

    public function dataProvider()
    {
        return array(
          array(2, 10, [["0.02", 1]]),
          array(1, 10, [["1.00", 1], ["2.00", 2], ["0.01", 1]]),
          array(10, 49.9, []),
          array(10, 100, [["2.00", 25], ["0.10", 1]]),
        );
    }
}
