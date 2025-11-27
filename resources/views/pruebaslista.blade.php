<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Pruebas|Lista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body class="p-4">

    <div class="container">
        <h1 class="mb-4">Agregar productos</h1>
        <h2>Nueva Venta</h2>

        <!-- Lista dinámica de productos -->
        <livewire:sale-list />
        <livewire:search-products />

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                Guardar Venta
            </button>
        </div>

    </div>

    {{-- Livewire scripts --}}
    @livewireScripts

    <script>
    let rowIndex = 0;
    let currentRowIndex = null;

    // Crear una fila nueva
    function addRow() {
        const tbody = document.querySelector("#saleTable tbody");

        const row = document.createElement("tr");
        row.dataset.index = rowIndex;

        row.innerHTML = `
            <td>
                <input type="hidden" name="products[${rowIndex}][product_id]" id="product-id-${rowIndex}">
                <input type="text" class="form-control" id="product-name-${rowIndex}" readonly>

                <button type="button" class="btn btn-secondary btn-sm mt-1" onclick="openSearch(${rowIndex})">
                    Buscar
                </button>
            </td>

            <td>
                <input type="number" name="products[${rowIndex}][price]" 
                    class="form-control price" id="price-${rowIndex}"
                    oninput="updateTotal(${rowIndex})">
            </td>

            <td>
                <input type="number" name="products[${rowIndex}][quantity]" 
                    class="form-control quantity" value="1"
                    id="qty-${rowIndex}"
                    oninput="updateTotal(${rowIndex})">
            </td>

            <td class="total" id="total-${rowIndex}">0</td>

            <td>
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">X</button>
            </td>
        `;

        tbody.appendChild(row);
        rowIndex++;
    }

    // Eliminar fila
    function removeRow(button) {
        button.closest("tr").remove();
    }

    // Abrir buscador Livewire y guardar qué fila lo llamó
    function openSearch(index) {
        currentRowIndex = index;
        Livewire.dispatch('open-search-products');
    }


    // Recibir producto seleccionado desde Livewire
    document.addEventListener('product-selected', function (e) {
        const data = e.detail;
        console.log("INPUT QUE ENCUENTRA JS:", document.getElementById(`product-name-${currentRowIndex}`));
        console.log("VALOR ANTES DE SETEAR:", document.getElementById(`product-name-${currentRowIndex}`).value);
        console.log("VALOR QUE ESTOY ASIGNANDO:", e.detail.name);

        document.getElementById(`product-id-${currentRowIndex}`).value = data.id;
        document.getElementById(`product-name-${currentRowIndex}`).value = data.name;
        document.getElementById(`price-${currentRowIndex}`).value = data.price;

        updateTotal(currentRowIndex);
    });

    // document.addEventListener('product-selected', function (e) {
    //     console.log("DATA RECIBIDA EXACTA DESDE LIVEWIRE:", e.detail);
    //     console.log("INPUT BUSCADO:", document.getElementById(`product-name-${currentRowIndex}`));
    // });
        // Calcular total
    function updateTotal(index) {
        const price = parseFloat(document.getElementById(`price-${index}`).value) || 0;
        const qty = parseFloat(document.getElementById(`qty-${index}`).value) || 0;

        const total = (price * qty).toFixed(2);
        document.getElementById(`total-${index}`).textContent = total;
    }
    </script>

    {{-- Bootstrap JS (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
