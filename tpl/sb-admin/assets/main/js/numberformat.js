function number_format(number, decimals, decPoint, thousandsSep){
	decimals = decimals || 0;
	number = parseFloat(number);

	if(!decPoint || !thousandsSep){
		decPoint = '.';
		thousandsSep = ',';
	}

	var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
	// add zeros to decimalString if number of decimals indicates it
	roundedNumber = (1 > number && -1 < number && roundedNumber.length <= decimals)
		      ? Array(decimals - roundedNumber.length + 1).join("0") + roundedNumber
		      : roundedNumber;
	var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber.slice(0);
	var checknull = parseInt(numbersString) || 0;
  
	// check if the value is less than one to prepend a 0
	numbersString = (checknull == 0) ? "0": numbersString;
	var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
	
	var formattedNumber = "";
	while(numbersString.length > 3){
		formattedNumber = thousandsSep + numbersString.slice(-3) + formattedNumber;
		numbersString = numbersString.slice(0,-3);
	}

	return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
}

//english format
number_format( 1234.50, 2, '.', ',' ); // ~> "1,234.50"

//german format
number_format( 1234.50, 2, ',', '.' ); // ~> "1.234,50"

//french format
number_format( 1234.50, 2, '.', ' ' ); // ~> "1 234.50"

//values less than 1
number_format( 0.505, 2, '.', ' ' ); // ~> "0.51"

//even works on 0
number_format( 0, 5, '.', ' ' ); // ~> "0.00000"


