## Files added/modified
	modified:   app/Providers/AppServiceProvider.php
	modified:   routes/api.php

	new file:   config/business-days.php
	new file:   app/Console/Commands/BusinessDaysSubscribe.php
	new file:   app/Http/Controllers/BusinessDateController.php
	
	new file:   app/Services/BusinessDayCalculator/BusinessDateWithDelay.php
	new file:   app/Services/BusinessDayCalculator/BusinessDatesPubSubInterface.php
	new file:   app/Services/BusinessDayCalculator/BusinessDay.php
	new file:   app/Services/BusinessDayCalculator/BusinessDayCalculator.php
	new file:   app/Services/BusinessDayCalculator/BusinessDayCalculatorInterface.php
	new file:   app/Services/BusinessDayCalculator/RedisPubSub.php
	
	new file:   tests/Unit/BusinessDayCalculatorTest.php
	
## CURL samples
`curl http://localhost/api/v1/businessDates/getBusinessDateWithDelay -X POST -H 'Content-Type: application/json' -d '{"initialDate": "2018-11-10T00:00:00Z","delay": 3}'`

`curl http://localhost/api/v1/businessDates/isBusinessDay -X POST -H 'Content-Type: application/json' -d '{"initialDate": "2018-11-11T00:00:00Z"}'`
	
## To run the redis subscriber
`php artisan business-days:subscribe`

## Test using Laradock

`cd laradock && docker-compose up nginx redis workspace`
