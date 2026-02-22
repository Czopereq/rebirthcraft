const itemModal = document.getElementById('itemModal');
const userNick = (typeof serverUserNick !== 'undefined') ? serverUserNick : 'Gracz';

let currentPrefixColor = "&f";
let currentPrefixText = "";

if (itemModal) {
    itemModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const productName = button.getAttribute('data-name');
        const productId = button.getAttribute('data-id');

        itemModal.querySelector('#modalItemName').textContent = productName;
        itemModal.querySelector('#modalItemId').value = productId;

        const nametag = document.getElementById('nametagPreview');
        const colorDiv = document.getElementById('colorOptions');
        const prefixDiv = document.getElementById('prefixOptions');
        const customInput = document.getElementById('customDataInput');
        const prefixInput = document.getElementById('prefixInput');

        nametag.style.color = 'white';
        nametag.textContent = userNick;
        colorDiv.classList.add('d-none');
        prefixDiv.classList.add('d-none');
        customInput.value = '';

        if (prefixInput) prefixInput.value = '';
        currentPrefixColor = "&f";
        currentPrefixText = "";
        document.querySelectorAll('.color-btn, .prefix-color-btn').forEach(b => b.classList.remove('active'));

        if (productId == '1') {
            colorDiv.classList.remove('d-none');
        }
        else if (productId == '2') {
            prefixDiv.classList.remove('d-none');
        }
    });
}
document.querySelectorAll('.color-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const colorCode = this.getAttribute('data-code');
        const colorHex = this.style.backgroundColor;

        document.getElementById('nametagPreview').style.color = colorHex;
        document.getElementById('customDataInput').value = colorCode;
    });
});
document.querySelectorAll('.prefix-color-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.prefix-color-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        currentPrefixColor = this.getAttribute('data-code');
        updatePrefixData();
    });
});
const prefixInput = document.getElementById('prefixInput');
if (prefixInput) {
    prefixInput.addEventListener('input', function () {
        currentPrefixText = this.value;
        updatePrefixData();
    });
}
function updatePrefixData() {
    const nametag = document.getElementById('nametagPreview');
    const hiddenInput = document.getElementById('customDataInput');

    if (currentPrefixText.length > 0) {
        const hexColor = getColorHex(currentPrefixColor);
        nametag.innerHTML = `<span style="color:#aaa">[</span><span style="color:${hexColor}">${currentPrefixText}</span><span style="color:#aaa">]</span> ${userNick}`;
        hiddenInput.value = currentPrefixColor + currentPrefixText;
    } else {
        nametag.textContent = userNick;
        hiddenInput.value = "";
    }
}

function getColorHex(code) {
    const colors = {
        '&4': '#AA0000', '&c': '#FF5555', '&6': '#FFAA00', '&e': '#FFFF55',
        '&2': '#00AA00', '&a': '#55FF55', '&b': '#55FFFF', '&3': '#00AAAA',
        '&1': '#0000AA', '&9': '#5555FF', '&d': '#FF55FF', '&5': '#AA00AA',
        '&f': '#FFFFFF', '&7': '#AAAAAA', '&0': '#000000'
    };
    return colors[code] || '#FFFFFF';
}