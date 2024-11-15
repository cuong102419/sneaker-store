document.getElementById('size-selector').addEventListener('change', function () {
    const selectedSizeId = this.value;
    const selectedSizeText = this.options[this.selectedIndex].text;

    if (document.getElementById(`size-${selectedSizeId}`)) {
        alert('Kích cỡ này đã được chọn. Vui lòng chọn kích cỡ khác.');
        return;
    }

    const container = document.getElementById('size-quantity-container');
    const newRow = document.createElement('div');
    newRow.classList.add('size-quantity-row', 'mb-2', 'd-flex', 'align-items-center');
    newRow.id = `size-${selectedSizeId}`;

    newRow.innerHTML = `
        <input type="hidden" name="sizes[]" value="${selectedSizeId}">
        <span class="me-2">${selectedSizeText}</span>
        <input type="number" name="quantities[]" class="form-control me-2" min="1" placeholder="Số lượng" required>
        <button type="button" class="btn btn-sm btn-danger remove-row">Xóa</button>
    `;

    container.appendChild(newRow);

    newRow.querySelector('.remove-row').addEventListener('click', function () {
        newRow.remove();
    });
});

