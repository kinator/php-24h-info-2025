<?php

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

function GETPOST($paramname)
{
    if (isset($_POST[$paramname]) && !empty($_POST[$paramname]))
        return $_POST[$paramname];
    if (isset($_GET[$paramname]) && !empty($_GET[$paramname]))
        return $_GET[$paramname];
    return null;
}

function GETPOSTISSET($paramname)
{
    return isset($_POST[$paramname]) || isset($_GET[$paramname]);
}

function toFloat($value)
{
    $float = (float)$value;
    if (fmod($float, 1) === 0.0) {
        return number_format($float, 1, '.', '');
    } else {
        return rtrim(rtrim((string)$float, '0'), '.');
    }
}

function sanitize($value)
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function desanitize($value)
{
    return htmlspecialchars_decode(trim($value), ENT_QUOTES);
}

function validateTypeInbound($value, $type) {
  $value = trim($value);
  if(!($value === 'NULL' ||$value === null || $value === "")) {
    switch ($type) {
      case 'integer':
        return is_int($value) ? $value : (int)$value;
      case 'boolean':
        if (in_array(strtolower($value), ['true', 't', 'oui', 'bool(true)', true, 1], 1)) return 'Oui';
        else if (in_array(strtolower($value), ['false', 'f', 'non', 'bool(false)', false, 0], 1)) return 'Non';
        else return $value ? 'Oui' : 'Non';
      case 'text':
        return is_string($value) ? sanitize($value) : sanitize("" . $value);
      case 'character varying':
        return is_string($value) ? sanitize($value) : sanitize("" . $value);
      case 'char':
        return is_string($value) ? sanitize($value) : sanitize("" . $value);
      case 'date':
        return $value;
      case 'timestamp':
        return $value;
      default:
        return $value;
    }
  }
  return null;
}

function validateTypeOutbound($value, $type) {
  $value = trim($value);
  if(!($value === 'NULL' || $value === null || $value === "")) {
    switch ($type) {
      case 'integer':
        return (int)$value;
      case 'smallint':
        return (int)$value;
      case 'double precision':
        return toFloat($value);
      case 'real':
        return toFloat($value);
      case 'boolean':
        if (in_array(strtolower($value), ['true', 't', 'oui', 'bool(true)', true, 1], 1) === true) return 'true';
        else if (in_array(strtolower($value), ['false', 'f', 'non', 'bool(false)', false, 0], 1) === true) return 'false';
        else return $value;
      case 'text':
        return $value;
      case 'character varying':
        return sanitize($value);
      case 'char':
        return "$value";
      case 'date':
        return $value;
      case 'timestamp':
        return $value;
      default:
        return $value;
    }
  }
  return null;
}

function getInputType($type, $pdo = false): string {
  if (!$pdo) {
    switch ($type) {
      case 'integer':
        return 'number';
      case 'double precision':
        return 'number';
      case 'real':
        return 'number';
      case 'smallint':
        return 'number';
      // case 'boolean':
      //   return 'checkbox';
      case 'email':
        return 'email';
      case 'text':
        return 'textarea';
      case 'character varying':
        return 'textarea';
      case 'date':
        return 'date';
      case 'timestamp':
        return 'date';
      default:
        return 'text';
    }
  } else {
    switch ($type) {
      case 'integer':
        return PDO::PARAM_INT;
      case 'boolean':
        return PDO::PARAM_BOOL;
      default:
        return PDO::PARAM_STR;
    }
  }
}