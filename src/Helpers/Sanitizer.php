<?php
// ============================================================
// BREVE DESCRIPCIÓN:
// Clase de sanitización de datos (OBLIGATORIA).
// Limpia entradas de usuario para prevenir XSS e inyecciones.
// Se usa en todos los controladores antes de procesar datos.
// ============================================================

namespace Helpers;

class Sanitizer
{
    public static function sanitizeString($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public static function sanitizeEmail($email)
    {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    public static function sanitizeInt($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function sanitizeFloat($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function sanitizeArray($array)
    {
        $sanitized = [];
        foreach ($array as $key => $value) {
            if (is_string($value)) {
                $sanitized[$key] = self::sanitizeString($value);
            } else {
                $sanitized[$key] = $value;
            }
        }
        return $sanitized;
    }

    public static function sanitizeFileName($filename)
    {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    }
}
