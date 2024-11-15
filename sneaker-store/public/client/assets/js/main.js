var selectedSizeValue = null;
function selectSize(button, sizeId, variantId) {
    document.querySelectorAll('.size-option').forEach(btn => btn.classList.remove('selected'));

    button.classList.add('selected');

    document.getElementById('selectedSize').value = variantId;
    selectedSizeValue = sizeId;
    toggleButton();
    deleteChangeSize();
}

function increase() {
    var quantity = document.getElementsByName('quantity')[0];
    var current = parseInt(quantity.value);
    quantity.value = current + 1;
}

function decrease() {
    var quantity = document.getElementsByName('quantity')[0];
    var current = parseInt(quantity.value);
    if (current > 1) {
        quantity.value = current - 1;
    }
}

function updateCart(variantId) {
    const quantity = document.getElementById(`quantity-cart-${variantId}`).value;

    const form = document.getElementById('form-quantity-' + variantId);

    form.querySelector('[name="quantity"]').value = quantity;

    form.submit();
}

function increaseCart(variantId) {
    var quantity = document.getElementById(`quantity-cart-${variantId}`);
    var current = parseInt(quantity.value);
    quantity.value = current + 1;

    updateCart(variantId)
}

function decreaseCart(variantId) {
    var quantity = document.getElementById(`quantity-cart-${variantId}`);
    var current = parseInt(quantity.value);
    if (current > 1) {
        quantity.value = current - 1;
    }

    updateCart(variantId)
}

function clearSelection() {
    document.querySelectorAll('.size-option').forEach(btn => btn.classList.remove('selected'));

    selectedSizeValue = null;
    document.getElementById('selectedSize').value = '';

    toggleButton();
    deleteChangeSize();
}

function toggleButton() {
    if (selectedSizeValue) {
        document.getElementById('buyNow').disabled = false;
        document.getElementById('addToCart').disabled = false;
    } else {
        document.getElementById('buyNow').disabled = true;
        document.getElementById('addToCart').disabled = true;
    }
}

function deleteChangeSize() {
    if (selectedSizeValue) {
        document.getElementById('deleteChange').hidden = false;
    } else {
        document.getElementById('deleteChange').hidden = true;
    }
}

const carousel = document.querySelector('.thumbnail-carousel');

let isDragging = false;
let startX;
let scrollLeft;

carousel.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.pageX - carousel.offsetLeft;
    scrollLeft = carousel.scrollLeft;
    carousel.style.cursor = 'grabbing';
});

carousel.addEventListener('mouseleave', () => {
    isDragging = false;
    carousel.style.cursor = 'grab';
});

carousel.addEventListener('mouseup', () => {
    isDragging = false;
    carousel.style.cursor = 'grab';
});

carousel.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - carousel.offsetLeft;
    const walk = (x - startX) * 0.5;
    carousel.scrollLeft = scrollLeft - walk;
});
