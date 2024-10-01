<?php
test('test_can_get_all_tasks', function () {
    $response = $this->get('/api/tasks');
    $response->assertStatus(200);
});
