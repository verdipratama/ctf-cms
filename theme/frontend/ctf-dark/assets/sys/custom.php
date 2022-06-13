<?php
if ($this->input->post()) {
	$data[0]['title'] = $this->input->post('title');
	$data[0]['typed'] = $this->input->post('typed');
	$data[0]['img'] = $this->input->post('img');
	$data[0]['description'] = $this->input->post('description');
	$data[0]['primary_color'] = $this->input->post('primary_color');
	$data[0]['footer'] = $this->input->post('footer');
	$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
	$anggota = file_put_contents("./theme/frontend/$websettings->theme_active/assets/sys/custom.json", $jsonfile);
	$this->session->set_flashdata('success', 'Successfully saved changes.');
	redirect(base_url("admin/themes/custom"));
}
?>


<form action="" method="post">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<small>Main</small>
					<hr>
					<div class="mb-3">
						<label for="example-select" class="form-label">Primary Color</label>
						<select class="form-select" name="primary_color">
							<option value="blue" <?= ($row['primary_color'] == 'blue') ? "selected" : "" ?>>Blue</option>
							<option value="bluelite" <?= ($row['primary_color'] == 'bluelite') ? "selected" : "" ?>>Bluelite</option>
							<option value="green" <?= ($row['primary_color'] == 'green') ? "selected" : "" ?>>Green</option>
							<option value="purple" <?= ($row['primary_color'] == 'purple') ? "selected" : "" ?>>Purple</option>
							<option value="red" <?= ($row['primary_color'] == 'red') ? "selected" : "" ?>>Red</option>
						</select>
					</div>
					<small>Header</small>
					<hr>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Title</label>
						<input type="text" name="title" class="form-control" value="<?= $row['title'] ?>">
					</div>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Typed</label>
						<input type="text" name="typed" class="form-control" value="<?= $row['typed'] ?>">
					</div>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Img</label>
						<input type="text" name="img" class="form-control" value="<?= $row['img'] ?>">
					</div>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Description</label>
						<textarea name="description" class="form-control" rows="10"><?= $row['description'] ?></textarea>
					</div>
					<small>Footer</small>
					<hr>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Footer</label>
						<input type="text" name="footer" class="form-control" value="<?= $row['footer'] ?>">
					</div>
					<div class="text-end">
						<button class="btn btn-primary" type="submit">Save Change</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>