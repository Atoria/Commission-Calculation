# Commission Fee Calculation

This project is a commission fee calculation system that calculates the commission fees for transactions made by private and business users. It also takes into account the deposit fees and fees of charge during the week. 

## Installation

To install this project, run the following command in the terminal:

`composer install`


## Environment Variables

The following environment variables are used in this project:

- `DEPOSIT_FEE`: Fee % of the deposits.
- `PRIVATE_WITHDRAW_COMMISSION_FEE`: Fee % for the private users on withdraw.
- `BUSINESS_WITHDRAW_COMMISSION_FEE`: Fee % for the business users on withdraw.
- `FEE_OF_CHARGE`: Fee of charge during the week.
- `MAX_FEE_CHARGE_COUNT`: Maximum number of transactions to apply fee of charge discount.
- `EXCHANGE_RATES_URL`: URL to fetch rates.
- `BASE_CURRENCY`: Base currency where Fees of charges are calculated.

Here are some example values for these variables:

- DEPOSIT_FEE=0.03;
- PRIVATE_WITHDRAW_COMMISSION_FEE=0.3;
- BUSINESS_WITHDRAW_COMMISSION_FEE=0.5;
- FEE_OF_CHARGE=1000;
- MAX_FEE_CHARGE_COUNT=3;
- EXCHANGE_RATES_URL=www.exchangerates.com;
- BASE_CURRENCY=EUR;



## Usage

### Endpoint

There is only one POST endpoint / which expects parameter file and it must be a csv file. The content-type must be multipart/form-data.

```
curl -X POST \
  http://example.com \
  -H 'Content-Type: multipart/form-data' \
  -F 'file=@/path/to/file.csv'

```

## Running Test

`php artisan test`



## Run application

`php artisan serve`




## License

This project is licensed under the MIT License - see the LICENSE.md file for details.
