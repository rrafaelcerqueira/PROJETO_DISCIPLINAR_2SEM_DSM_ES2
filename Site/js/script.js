document.addEventListener('DOMContentLoaded', () => {

  const uploadInput = document.getElementById('uploadBackground');
  const removeButton = document.getElementById('removeBackground');
  const body = document.body;

  function applyBackground(imageUrl) {
    if (imageUrl) {
      body.style.backgroundImage = `url('${imageUrl}')`;
      body.style.backgroundSize = 'cover';
      body.style.backgroundPosition = 'center';
      body.style.backgroundAttachment = 'fixed';
    } else {
      body.style.backgroundImage = '';
      body.style.backgroundSize = '';
      body.style.backgroundPosition = '';
      body.style.backgroundAttachment = '';
    }
  }

  function loadBackground() {
    const savedImage = localStorage.getItem('userBackground');
    if (savedImage) {
      applyBackground(savedImage);
    }
  }

  uploadInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = (e) => {
      const imageUrl = e.target.result;

      try {
        localStorage.setItem('userBackground', imageUrl);
        applyBackground(imageUrl);
      } catch (error) {
        console.error("Erro ao salvar no localStorage:", error);
        alert("Erro: A imagem é muito grande (limite de ~5MB) e não pode ser salva. Tente uma imagem menor.");
      }
    };

    reader.readAsDataURL(file);
    uploadInput.value = null;
  });

  removeButton.addEventListener('click', () => {
    localStorage.removeItem('userBackground');
    applyBackground(null);
  });

  loadBackground();

document.querySelectorAll('.edit-categoria').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nome = this.getAttribute('data-nome');
        
        document.getElementById('edit_id_categoria').value = id;
        document.getElementById('edit_nome_categoria').value = nome;
        
        const modal = new bootstrap.Modal(document.getElementById('editCategoriaModal'));
        modal.show();
    });
});

});