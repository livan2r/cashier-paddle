<?php

namespace Laravel\Paddle;

use Money\Currency;

class Price
{
    /**
     * The price attributes.
     *
     * @var array
     */
    protected $price;

    /**
     * The price's currency.
     *
     * @var \Money\Currency
     */
    protected $currency;

    /**
     * Create a new Price instance.
     *
     * @param  array  $price
     * @param  \Money\Currency  $currency
     * @return void
     */
    public function __construct(array $price, Currency $currency)
    {
        $this->price = $price;
        $this->currency = $currency;
    }

    /**
     * Get the gross amount.
     *
     * @return string
     */
    public function gross()
    {
        return $this->formatAmount((int) ($this->rawGross() * 100));
    }

    /**
     * Get the raw gross amount.
     *
     * @return string
     */
    public function rawGross()
    {
        return $this->price['gross'];
    }

    /**
     * Get the net amount.
     *
     * @return string
     */
    public function net()
    {
        return $this->formatAmount((int) ($this->rawNet() * 100));
    }

    /**
     * Get the raw net amount.
     *
     * @return string
     */
    public function rawNet()
    {
        return $this->price['net'];
    }

    /**
     * Get the used currency for the transaction.
     *
     * @return \Money\Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * Format the given amount into a displayable currency.
     *
     * @param  int  $amount
     * @return string
     */
    protected function formatAmount($amount)
    {
        return Cashier::formatAmount($amount, $this->currency);
    }

    /**
     * Dynamically get values from the Paddle transaction.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->product[$key];
    }
}
