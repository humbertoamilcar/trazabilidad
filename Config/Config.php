<?php
// ==========================
// CONFIGURACIÓN DE LA APP
// ==========================

const BASE_URL = "http://192.168.0.109/pventas/";
const DEBUG = true;
const APP_TIMEZONE = 'America/Lima';
const SESSION_NAME = 'trazabilidad_session';
const CSRF_TOKEN_NAME = 'csrf_token';

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "12345678";
const DB_NAME = "trazabilidad";
const DB_CHARSET = "utf8mb4";

const UPLOAD_MAX_SIZE_MB = 10;
const UPLOAD_ALLOWED_EXT = ['jpg','jpeg','png','webp','pdf'];
const UPLOAD_DIR = __DIR__ . '/../storage/uploads';

const PAGINATION_PER_PAGE = 20;

date_default_timezone_set(APP_TIMEZONE);

if (DEBUG) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

session_name(SESSION_NAME);

if (!defined('base_url')) {
    define('base_url', BASE_URL);
}

function base_url(string $path = ''): string {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}
