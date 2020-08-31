const keyword = document.querySelector('.keyword');
const container = document.querySelector('.search');

keyword.addEventListener('keyup', function () {
  fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response))
});

function previewImg() {
  const gambar = document.querySelector('.gambar');
  const imgPreview = document.querySelector('.img-preview');

  const oFReader = new FileReader();

  oFReader.readAsDataURL(gambar.files[0]);
  oFReader.onload = function (OFREvent) {
    imgPreview.src = OFREvent.target.result;
  };
}