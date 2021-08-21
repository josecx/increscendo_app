<template>
        <div>
            <h2 class="title-carrito">Carrito de compras</h2>
            <div class="content-cart">
                <div class="list-product-cart">
                    <table class="table-product-cart">
                        <tr class="encabezado-list-cart">
                            <th>Artículo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                        <tr class="line-list-product">
                            <td><img src="../../assets/img/logo-principal.svg" alt="logo-increscendo" id="logo-sidebar-menu"></td>
                            <td>Q100</td>
                            <td><input type="number" id="points" name="points" step="3"></td>
                            <td>Q2,800 <span class="delete-from-list-cart"><i class="far fa-trash-alt"></i></span></td>
                        </tr>
                    </table>
                </div>
                <div class="resume-cart">
                    <h2>Resumen</h2>
                    <!-- <p>Use width: 100% to create a full-width table:</p> -->
                    <table class="table-resume-cart">
                        <tr>
                            <td>Subtotal <span>Q100</span></td>
                        </tr>
                        <tr>
                            <td>Total de la Orden <span>Q1000</span></td>
                        </tr>
                        <tr>
                            <td id="btn-submit-cart-pay"><button>Continuar con la compra</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</template>
<script>
import "../../assets/css/carrito.css";
export default {
    name: "Carrito",
}
</script>