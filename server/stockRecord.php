<?php
/*Author: Thu Nguyen, 000832893
* Date:  2022
* Purpose: Placeholder for later
* Statement of Authorship: I, Thu Nguyen, 000832893 certify that this material is my
*  original work. No other person's work has been used without due acknowledgement.
*/

    class stockRecord implements JsonSerializable {
        private $stockId;
        private $stockName;
        private $stockPrice;

        function __construct($stockId,$stockName,$stockPrice)
        {
            $this->id = $stockId;
            $this->name = $stockName;
            $this->price = $stockPrice;

        }

        function jsonSerialize(): mixed
        {
            return array("id"=>$this->id,"name"=>$this->name,"price"=>$this->price);
        }
    }
?>