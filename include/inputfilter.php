<?php
  function filterIntegar($input){
    return filter_var($input,FILTER_VALIDATE_INT);
  }
  function filterFloat($input){
    return filter_var($input,FILTER_SANATIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
  }
  function filterString($input){
    return htmlentities(strip_tags($input),ENT_QUOTES,'UTF-8');
  }
  function filterEmail($input){
    return filter_var($input, FILTER_VALIDATE_EMAIL);
  }
