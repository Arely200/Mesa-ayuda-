<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Clase de validación de datos (OBLIGATORIA).
// Valida emails, contraseñas (RNF-05: 8-12 caracteres),
// campos requeridos, formatos de fecha, etc.
// ============================================================

namespace Helpers;

class Validator
{
    public static function validatePassword($password)
    {
        $length = strlen($password);
        if ($length < 8 || $length > 12) {
            throw new \Exception('La contraseña debe tener entre 8 y 12 caracteres');
        }
        return true;
    }

    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email inválido');
        }
        return true;
    }

    public static function validateRequired($data, $fields)
    {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                throw new \Exception("El campo $field es obligatorio");
            }
        }
        return true;
    }

    public static function validateIdentificacion($identificacion)
    {
        if (!preg_match('/^[0-9]{1,20}$/', $identificacion)) {
            throw new \Exception('Identificación inválida. Solo números.');
        }
        return true;
    }

    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
