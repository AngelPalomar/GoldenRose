<?php

session_start();
require('scripts/db_connection.php');

/**
 * Acciones
 * 
 * agregar = agrega productos al carrito
 * eliminar = elimina producto seleccionado del carrito
 * vaciar = vacía el carrito
 */

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    switch ($accion) {
        /**Agregar item */
        case 'agregar': {
            if (isset($_GET['id']) && isset($_GET['cantidad'])) {
                $idProducto = $_GET['id'];
                $cantidad = $_GET['cantidad'];

                /**Info del producto */
                $cmd = "SELECT producto.id AS ID, producto.nombre AS NOMBRE_PROC,
                producto.precio AS PRECIO, producto.pathImagen AS IMAGEN
                FROM producto
                WHERE producto.id = '$idProducto'";

                $query = $mysqli->query($cmd);

                if ($query->num_rows === 1) {
                    $datosProducto = $query->fetch_array(MYSQLI_ASSOC);
                    /**Nuevo campo "cantidad" */
                    $datosProducto['CANTIDAD'] = $cantidad;
                    /**Variable bandera */
                    $isEncontrado = false;

                    /**Insertar en carrito de carrito si está vacío */
                    if (sizeof($_SESSION['carrito']) === 0 ) {
                        $_SESSION['carrito'][] = $datosProducto;
                    } else {
                        /**Busca ID igual */
                        for ($i=0; $i < sizeof($_SESSION['carrito']); $i++) { 
                            if ($_SESSION['carrito'][$i]['ID'] === $datosProducto['ID']) {
                                $_SESSION['carrito'][$i]['CANTIDAD'] += 1;
                                $isEncontrado = true;
                                break;
                            } else {
                                $isEncontrado = false;
                            }
                        }

                        /**Verificamos si encontró un producto igual 
                         * Si no fue encontrado, agrega un producto
                        */
                        if (!$isEncontrado) {
                            /**Añadimos el nuevo producto */
                            $_SESSION['carrito'][] = $datosProducto;
                        }
                    }

                    /**Redirección a ver carrito*/
                    header('Location:ver_carrito.php?mensajeCarrito=1');

                } else {
                    /**Si no encontró productos */
                    header('Location:index.php');
                }
                
            } else {
                /**Si no llegó ID ni CANTIDAD */
                header('Location:index.php');
            }
            
        } break;

        /**Actualizar cantidades */
        case 'actualizar': {
            if (isset($_GET['cantidad']) && isset($_GET['idProducto'])) {
                $cantidad = $_GET['cantidad'];
                $idProducto = $_GET['idProducto'];

                if (is_array($cantidad) && is_array($idProducto)) {

                    /**Recorremos el carrito actualizando las cantidades */
                    for ($i=0; $i < sizeof($cantidad); $i++) { 

                        /**BUSCAMOS EL PRODUCTO EN INVENTARIO SI HAY SUFICIENTES EXISTENCIAS */
                        $buscarExistencias = "SELECT MAX(cantidad) AS EXISTENCIAS 
                        FROM inventario
                        WHERE idProducto = '$idProducto[$i]' AND cantidad > 0
                        GROUP BY idProducto";

                        $query = $mysqli->query($buscarExistencias);

                        /**Buscamos las existencias actuales de ese producto */
                        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                            $existencias = $row['EXISTENCIAS'];
                        }

                        /**SI LA CANTIDAD ESCRITA ES MENOR O IGUAL A LA DE INVENTARIO MAYOR */
                        if ($cantidad[$i] <= $existencias) {
                            /**Posición cantidad = nuevo valor */
                            $_SESSION['carrito'][$i]['CANTIDAD'] = $cantidad[$i];
                            header('Location:ver_carrito.php?mensajeCarrito=2');
                        } else {
                            header('Location:ver_carrito.php?mensajeCarrito=3&nombreProducto='.$_SESSION['carrito'][$i]['NOMBRE_PROC']);
                        }
                    }
                    
                } else {
                    /**Si no es arreglo */
                    header('Location:ver_carrito.php');
                }
                
            } else {
                /**Si no llega las cantidades */
                header('Location:index.php');
            }
            
        } break;

        /**Eliminar ítem */
        case 'eliminar': {
            if (isset($_GET['id'])) {
                $idProducto = $_GET['id'];

                /**Recorrido del carrito para encontrar el que se quiere eliminar */
                for ($i=0; $i < sizeof($_SESSION['carrito']); $i++) { 
                    if ($_SESSION['carrito'][$i]['ID'] === $idProducto) {
                        /**Borrar ese producto */
                        array_splice($_SESSION['carrito'], $i, 1);
                    }
                }

                /**Si ya no hay elementos, destruir el carrito */
                if (sizeof($_SESSION['carrito']) == 0) {
                    unset($_SESSION['carrito']);
                }

                /**Regresar a la tienda */
                header('Location:ver_carrito.php');
            } else {
                /**No llegó ID para eliminar */
                header('Location:ver_carrito.php');
            }
        } break;

        /**Vaciar carrito */
        case 'vaciar': {
            unset($_SESSION['carrito']);
            header('Location:ver_carrito.php');
        } break;

        default: 
            header('Location:ver_carrito.php');
            break;
    }

} else {
    /**Si no llega acción */
    header('Location:ver_carrito.php');
}


?>