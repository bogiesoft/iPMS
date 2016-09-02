<?php

namespace iPMS;

$PROJECT_GROUP1 = array(
	0x0001 => "Camera",
	0x0002 => "Recoder",
	0x0004 => "Solution",
	0x0008 => "Product",
);
$PROJECT_GROUP2 = array(
	0x1000 => "개발1실",
	0x2000 => "개발2실",
);
$PROJECT_GROUP = array_merge($PROJECT_GROUP1, $PROJECT_GROUP2);

$DEVELOP_GROUP = array(
	0x0001 => "연구1팀",
	0x0002 => "연구2팀",
	0x0004 => "연구3팀",
	0x0008 => "연구4팀",
	0x0010 => "연구5팀",
	0x0020 => "연구6팀",
	0x0040 => "연구7팀",
	0x0080 => "연구8팀",
	0x0100 => "기구팀",
	0x0200 => "디자인팀",
	0x0400 => "연구기술팀",
);

$USER_GROUP = array(
	"-1" => "미승인",
	"0"  => "Administrator",
	"1"  => "Manager",
	"10" => "PMO",
	"11" => "PM",
	"12" => "PL",
	"99" => "Guest",
);

$PROJECT_LEVEL = array(
	"1"  => "PM1",
	"2"  => "PM2",
	"3"  => "PM3",
	"4"  => "설계변경",
	"10" => "상품도입",
	"99" => "기타",
);

$PROJECT_STATUS = array (
	"-1" => "Template",
	"0"  => "검토중",
	"1"  => "경영계획",
	"2"  => "상품승인",
	"10" => "개발계획",
	"11" => "개발중",
	"20" => "완료",
	"21" => "취소",
	"99" => "삭제",
);
