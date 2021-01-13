const flashData = $('.flashdata').data('flashdata');
const flashError = $('.flashdata_error').data('flashdata2');
if (flashData) {
	Swal.fire({
		title: flashData,
		text: 'Klik OK',
		icon: 'success'
	});
}
if (flashError) {
	console.log(flashError);
	Swal.fire({
		title: flashError,
		text: 'Klik OK',
		icon: 'error'
	});
}
$(".tombol-delete").on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah Anda Yakin Data Akan Dihapus ?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Hapus Data!'
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	})

})
$(".logout").on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah Anda Yakin Akan Keluar ?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Saya Keluar!'
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	})

})
$(".tombol-tanya").on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah Anda Yakin ?',
		icon: 'warning',

		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya',
		reverseButtons: true,
		showCancelButton: true,
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	})

})
