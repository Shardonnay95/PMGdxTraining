
<?php

class ItemOwners {
    public static function groupByOwners($ItemsArr) {
        $OwnersItemsArr = array();

        foreach ($ItemsArr as $ItemStr => $OwnerStr) {
            if (!isset($OwnersItemsArr[$OwnerStr])) {
                $OwnersItemsArr[$OwnerStr] = array();
            }
            $OwnersItemsArr[$OwnerStr][] = $ItemStr;
        }

        return $OwnersItemsArr;
    }
}

$ItemsArr = array(
    "Baseball Bat" => "John",
    "Golf ball" => "Stan",
    "Tennis Racket" => "John",
    "Stan" => "Cap",
);
echo json_encode(ItemOwners::groupByOwners($ItemsArr));

?>