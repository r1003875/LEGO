<?php
    class Admin extends User{
        public function canAddProduct(){
            return true;
        }
    }