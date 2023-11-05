<?php

/*
    Below you'll find a class called Invoice. The class is a very simple implementation of
    basic invoicing functionalities. It keeps track of the invoice number, customer, lines,
    and discount.

    It automatically calculates the total and applies the discount (if any).

    Problem Statement:
    ==================

    It is poorly written code. There are many ways this class could be refactored into a
    much more manageable codebase. It's your job to rewrite the class and its usage that is
    more future proof than what it is now.

    There is no one correct solution to the problem. All solutions are correct as long as
    we get to see your art in it.

    Everybody can write code that a computer understands. Only few can write that a human understands.
*/

class Invoice
{
    protected $number;
    protected $customer;
    protected $lines = [];
    protected $total = 0;
    protected $discount = 0;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function setCustomer($name, $address)
    {
        $this->customer = [
            'name'     => $name,
            'address' => $address,
        ];
    }

    public function addLine($description, $quantity, $rate)
    {
        $amount = $quantity * $rate;
        $this->lines[] = [
            'description' => $description,
            'quantity'    => $quantity,
            'rate'        => $rate,
            'amount'      => $amount,
        ];

        $this->total += $amount;
    }

    public function addDiscount($percent)
    {
        $this->discount = $percent;

        $this->total -= $this->total * ($percent / 100);
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getLines()
    {
        return $this->lines;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getNumber()
    {
        return $this->number;
    }
}

// This is only to show how this class is used. No need to refactor the following code.
// Of course, feel free to adjust it to the changes you make in the class itself.
$invoice = new Invoice('REF-0211-2022');
$invoice->setCustomer('Tiny India Pvt Ltd', 'India');
$invoice->addLine('Monthly Subscription of Product A', 3, 9.99);
$invoice->addLine('Annual Subscription of Product B', 2, 199.99);
$invoice->addDiscount(10);

echo '============= INVOICE ' . $invoice->getNumber() . ' =============' . PHP_EOL;
echo 'CUSTOMER:' . PHP_EOL;
echo $invoice->getCustomer()['name'] . PHP_EOL;
echo $invoice->getCustomer()['address'] . PHP_EOL;
echo PHP_EOL;
echo 'LINES:' . PHP_EOL;
foreach ($invoice->getLines() as $line)
{
    echo $line['description'] . ' ============= ' . $line['quantity'] . 'x' . $line['rate'] . ' = ' . $line['amount'] . PHP_EOL;
}
echo PHP_EOL;
echo 'Discount ============= ' . $invoice->getDiscount() . PHP_EOL;
echo 'Total ============= ' . $invoice->getTotal() . PHP_EOL;