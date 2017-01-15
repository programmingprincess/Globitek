<?php

  // is_blank('abcd')
  function is_blank($value='') {
    if(strlen(trim($value)) == 0) 
      return true;
    else
      return false;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $len = strlen($value);
    if(isset($options['max']) && ($len > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($len < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL) &&
          preg_match('/@.+\./', $value);
  }

?>
