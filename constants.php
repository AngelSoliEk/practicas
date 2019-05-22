<?php
const DS    = DIRECTORY_SEPARATOR;
const DR    = __DIR__ . DS;
const PHP   = '.php';

const APP   = 'App' . DS;
const CORE  = 'Core' . DS;
const MODELS = 'Models' . DS;
const CONTROLLERS = 'Controllers' . DS;

const APP_MODELS         = APP . MODELS;
const APP_CONTROLLERS   = APP . CONTROLLERS;


const FULL_APP_MODELS         = DR . APP_MODELS;
const FULL_APP_CONTROLLERS    = DR . APP_CONTROLLERS;

const CORE_MODEL        = CORE . 'Model' . DS . 'Model' . PHP;
const CORE_CONTROLLER   = CORE . 'Controller' . DS  . 'Controller' . PHP;

const FULL_CORE_MODEL        = DR . CORE_MODEL;
const FULL_CORE_CONTROLLER   = DR . CORE_CONTROLLER;