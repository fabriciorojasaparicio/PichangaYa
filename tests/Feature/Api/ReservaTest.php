<?php

test('api reserva endpoint requires authentication', function () {
    $response = $this->postJson('/api/reservar', [
        'cancha_id' => 1,
        'slots' => [1]
    ]);

    $response->assertStatus(401);
});

test('api mis reservas endpoint requires authentication', function () {
    $response = $this->getJson('/api/mis-reservas');

    $response->assertStatus(401);
});
