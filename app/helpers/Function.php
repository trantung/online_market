<?php
function getRole($roleId) {
	$role = array(
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
	);
	return $role[$roleId];
}

function selectRoleId()
{
	return array(
		'' => '-- Lựa chọn',
		ADMIN => 'ADMIN',
		EDITOR => 'EDITOR',
	);
}
// show 0 for null
function getZero($number = null)
{
	if($number != '') {
		return $number;
	}
	return 0;
}
//get extension from filename
function getExtension($filename = null)
{
	if($filename != '') {
		return pathinfo($filename, PATHINFO_EXTENSION);
	}
	return null;
}
//get filename from filename
function getFilename($filename = null)
{
	if($filename != '') {
		return pathinfo($filename, PATHINFO_FILENAME);
	}
	return null;
}

//change filename to time
function changeFileNameImage($filename)
{
	$now = strtotime(date('Y-m-d H:i:s'));
	$extension = getExtension($filename);
	return $now.'.'.$extension;
}

//Product type
function getProductType($id) {
	$arr = array(
		TYPEVALUE1 => TYPE1,
		TYPEVALUE2 => TYPE2,
	);
	return $arr[$id];
}

function selectProductType()
{
	return array(
		'' => '-- Loại sản phẩm',
		TYPEVALUE1 => TYPE1,
		TYPEVALUE2 => TYPE2,
	);
}

//Product status
function getProductStatus($id) {
	$arr = array(
		ACTIVE => PRODUCT_STATUS_1,
		INACTIVE => PRODUCT_STATUS_2,
		REFUSE => PRODUCT_STATUS_3,
	);
	return $arr[$id];
}

function selectProductStatus()
{
	return array(
		'' => '-- Lựa chọn',
		ACTIVE => PRODUCT_STATUS_1,
		INACTIVE => PRODUCT_STATUS_2,
		REFUSE => PRODUCT_STATUS_3,
	);
}

function generateRandomString($length = RANDOMSTRING) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function fullPriceVnd($number)
{
    if ($number > 0)
        $text = number_format($number, 0, ",", ".");
    else
        $text = 0;

    return $text;
}

function priceArrangeString($min, $max = null)
{
	$string = '';
	if(isset($min) && isset($max)) {
		$string .= 'Từ ' . fullPriceVnd($min) . ' - ' . fullPriceVnd($max);
	}
	if(isset($min) && !isset($max)) {
		$string .= 'Trên ' . fullPriceVnd($min);
	}
	return $string;
}

//list select field product
function listFieldProduct()
{
	return ['id', 'name', 'avatar', 'price', 'price_id', 'category_id', 'user_id', 'type_id', 'city_id', 'start_time', 'status', 'position', 'deleted_at', 'created_at'];
}

function listFieldSearch()
{
	return ['id', 'name', 'price_id', 'category_id', 'user_id', 'type_id', 'time_id', 'lat', 'long', 'created_at'];
}

function listFieldUser()
{
	return ['id', 'facebook_id', 'google_id' , 'username', 'avatar', 'email', 'phone', 'address', 'lat', 'long', 'type', 'status', 'created_at'];
}

function getProductTime($id) {
	$arr = array(
		TIMEVALUE1 => TIME1,
		TIMEVALUE2 => TIME2,
		TIMEVALUE3 => TIME3,
	);
	return $arr[$id];
}

function selectProductTime()
{
	return array(
		'' => '-- Lựa chọn',
		TIMEVALUE1 => TIME1,
		TIMEVALUE2 => TIME2,
		TIMEVALUE3 => TIME3,
	);
}

// tra ve time de so sanh tim kiem products
function getTime($timeId)
{
	$rs = '';
	switch ($timeId) {
		case TIMEVALUE1:
			$rs = date('Y-m-d 00:00:00');
			break;
		case TIMEVALUE2:
			$rs = date('Y-m-d 00:00:00', strtotime('monday last week'));
			break;
		case TIMEVALUE3:
			$rs = date("Y-m-d 00:00:00", strtotime("first day of previous month"));
			break;
		default:
			$rs = date('Y-m-d 00:00:00');
			break;
	}
	return $rs;
}

function getFullPriceInVnd($number)
{
    if ($number > 0)
        $text = number_format($number, 0, ",", ".");
    else
        $text = 0;

    return $text;
}

/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}


/**
 * Calculates the great-circle distance between two points, with
 * the Vincenty formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}

