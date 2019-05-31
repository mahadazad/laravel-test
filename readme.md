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
	
## To run the redis subscriber
`php artisan business-days:subscribe`

## Test using Laradock

`cd laradock && docker-compose up nginx redis workspace`
