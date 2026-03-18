export function previewImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Check file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showToast('File terlalu besar. Maksimal 5MB.', 'error');
                input.value = '';
                return;
            }

            // Check file type
            if (!file.type.match('image.*')) {
                showToast('File harus berupa gambar.', 'error');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('uploadArea').classList.add('hidden');
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('submitCompleteBtn').disabled = false;
            }
            reader.readAsDataURL(file);
        }
    }

export function removeImage() {
        document.getElementById('buktiFile').value = '';
        document.getElementById('uploadArea').classList.remove('hidden');
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('submitCompleteBtn').disabled = true;
    }
