<?php

function assets($path) {
    return 'public/' . trim($path, '/');
}
