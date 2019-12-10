$(document).ready(function () {
	const base_url = "http://localhost/olshop/";

	$('.showNewMenuModal').on('click', function (e) {
		e.preventDefault();
		$('#addNewMenuLabel').html('Add New Menu');
		$('.modal-footer button[type=submit]').html('Add Menu');
		$('.modal-body form').attr("action", base_url + "menu/addMenu");

		$('#id').val("");
		$('#menu_id').val("");
		$('#menu').val("");

	});

	$('.showEditMenu').on('click', function (e) {
		e.preventDefault();
		$('#addNewMenuLabel').html('Edit Menu');
		$('.modal-footer button[type=submit]').html('Edit Menu');
		$('.modal-body form').attr("action", base_url + "menu/editMenu");

		const id = $(this).data('id');
		console.log(id);


		$.ajax({

			url: base_url + 'menu/getedit',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id').val(data.id);
				$('#menu_id').val(data.menu_id);
				$('#menu').val(data.menu);

			}

		});


	});



	$('.showNewSubmenuModal').on('click', function (e) {
		e.preventDefault();
		$('#addNewSubmenuLabel').html('Add New Submenu');
		$('.modal-footer button[type=submit]').html('Add Submenu');
		$('.modal-body form').attr("action", base_url + "menu/addSubmenu");

		$('#id').val("");
		$('#menu_id').val("");
		$('#title').val("");
		$('#url').val("");
		$('#icon').val("");

	});

	$('.showEditSubmenu').on('click', function (e) {
		e.preventDefault();
		$('#addNewSubmenuLabel').html('Edit Submenu');
		$('.modal-footer button[type=submit]').html('Edit Submenu');
		$('.modal-body form').attr("action", base_url + "menu/editSubmenu");

		const id = $(this).data('id');


		$.ajax({

			url: base_url + 'menu/geteditSubmenu',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id').val(data.id);
				$('#menu_id').val(data.menu_id);
				$('#title').val(data.title);
				$('#url').val(data.url);
				$('#icon').val(data.icon);
			}

		});


	});





	$('.showNewRoleModal').on('click', function (e) {
		e.preventDefault();
		$('#addNewRoleLabel').html('Add New Role');
		$('.modal-footer button[type=submit]').html('Add Role');
		$('.modal-body form').attr("action", base_url + "admin/addRole");

		$('#id').val("");
		$('#role_id').val("");
		$('#role').val("");

	});


	$('.showEditRole').on('click', function (e) {
		e.preventDefault();
		$('#addNewRoleLabel').html('Edit Role');
		$('.modal-footer button[type=submit]').html('Edit Role');
		$('.modal-body form').attr("action", base_url + "admin/editRole");

		const id = $(this).data('id');


		$.ajax({

			url: base_url + 'admin/geteditRole',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#id').val(data.id);
				$('#role_id').val(data.role_id);
				$('#role').val(data.role);
			}

		});


	});

	$('.form-check-input').on('click', function (e) {
		e.preventDefault();
		const menuId = $(this).data('menu');
		const roleId = $(this).data('role');

		$.ajax({
			url: base_url + 'admin/changeaccess',
			data: {
				menuId: menuId,
				roleId: roleId
			},
			method: 'post',
			// dataType: 'json',
			success: function () {
				document.location.href = base_url + 'admin/roleAccess/' + roleId;
			}
		});

	});


	$('.custom-file-input').on('change', function () {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});

	$('.showDes').on('click', function (e) {
		e.preventDefault();
		const id = $(this).data('id');

		$.ajax({

			url: base_url + 'user/getitem',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('.description').html(data.description);
			}

		});

	});


});
