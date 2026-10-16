// Limpieza inmediata de URL para eliminar index.php de la barra de direcciones (local y producción)
(function limpiarUrlIndex() {
    if (window.location.pathname.endsWith("/index.php") || window.location.pathname === "/index.php") {
        const rutaLimpia = window.location.pathname.replace(/\/index\.php$/, "/") || "/";
        const urlFinal = rutaLimpia + window.location.search + window.location.hash;
        window.history.replaceState(null, "", urlFinal);
    }
})();

document.addEventListener("DOMContentLoaded", function () {
    const encabezado = document.getElementById("encabezado-principal");
    const umbralDesplazamiento = 40;

    function actualizarEncabezado() {
        if (!encabezado) return;
        if (window.scrollY > umbralDesplazamiento) {
            encabezado.classList.add("encabezado--solido");
        } else {
            encabezado.classList.remove("encabezado--solido");
        }
    }

    window.addEventListener("scroll", actualizarEncabezado, { passive: true });
    actualizarEncabezado();

    /* ==========================================================================
       INDICADOR ACTIVO DEL MENÚ Y SCROLLSPY (SINCRONIZACIÓN DE SECCIONES)
       ========================================================================== */
    const enlacesNavegacion = document.querySelectorAll(".enlace-menu[data-seccion], .enlace-movil[data-seccion]");
    const esPaginaInicio = document.body.classList.contains("pagina-inicio") || 
                           window.location.pathname === "/" || 
                           window.location.pathname.endsWith("/index.php") ||
                           window.location.pathname.endsWith("/");

    function activarEnlace(seccionId) {
        enlacesNavegacion.forEach(function (enlace) {
            const coincide = enlace.getAttribute("data-seccion") === seccionId;
            enlace.classList.toggle("activo", coincide);
            if (coincide) {
                enlace.setAttribute("aria-current", "page");
            } else {
                enlace.removeAttribute("aria-current");
            }
        });
    }

    if (esPaginaInicio) {
        // Secciones principales a monitorear en el orden que aparecen
        const seccionesScroll = [
            { id: "inicio", el: document.getElementById("inicio") },
            { id: "lineas", el: document.getElementById("lineas") },
            { id: "nosotros", el: document.getElementById("nosotros") },
            { id: "contacto", el: document.getElementById("contacto") }
        ].filter(function (s) { return s.el !== null; });

        let bloqueoScrollSpyPorClic = false;
        let temporizadorBloqueo = null;

        function calcularSeccionActiva() {
            if (bloqueoScrollSpyPorClic) return;

            const scrollPos = window.scrollY || window.pageYOffset;
            const alturaEncabezado = encabezado ? encabezado.offsetHeight : 70;
            const alturaVentana = window.innerHeight;
            const scrollTotal = document.documentElement.scrollHeight;

            // Si el usuario llega al final de la página, activar 'contacto'
            if (scrollPos + alturaVentana >= scrollTotal - 50) {
                activarEnlace("contacto");
                return;
            }

            // Si está al tope del sitio
            if (scrollPos < 100) {
                activarEnlace("inicio");
                return;
            }

            let idActivo = "inicio";
            const puntoCorte = scrollPos + alturaEncabezado + 140;

            for (let i = 0; i < seccionesScroll.length; i++) {
                const sec = seccionesScroll[i];
                if (puntoCorte >= sec.el.offsetTop) {
                    idActivo = sec.id;
                }
            }

            activarEnlace(idActivo);
        }

        // Revisar si la URL viene con hash específico (ej. #nosotros, #lineas, #contacto)
        function comprobarHashUrl() {
            const hash = window.location.hash.replace("#", "").toLowerCase();
            if (hash) {
                if (["inicio", "lineas", "nosotros", "contacto"].includes(hash)) {
                    activarEnlace(hash);
                    return true;
                }
                if (hash === "enfoque" || hash === "quienes-somos") {
                    activarEnlace("nosotros");
                    return true;
                }
            }
            return false;
        }

        if (!comprobarHashUrl()) {
            calcularSeccionActiva();
        }

        window.addEventListener("scroll", function () {
            calcularSeccionActiva();
        }, { passive: true });

        window.addEventListener("hashchange", function () {
            if (!comprobarHashUrl()) {
                calcularSeccionActiva();
            }
        });

        // Al dar clic en un enlace del navbar, mover de inmediato la línea indicadora
        enlacesNavegacion.forEach(function (enlace) {
            enlace.addEventListener("click", function () {
                const seccion = this.getAttribute("data-seccion");
                if (seccion && seccion !== "tienda") {
                    activarEnlace(seccion);
                    bloqueoScrollSpyPorClic = true;
                    if (temporizadorBloqueo) clearTimeout(temporizadorBloqueo);
                    temporizadorBloqueo = setTimeout(function () {
                        bloqueoScrollSpyPorClic = false;
                        calcularSeccionActiva();
                    }, 800);
                }
            });
        });
    } else {
        // En cualquier otra página (privacidad.php, cycles, etc.), no marcar 'inicio' como activo
        activarEnlace(null);
    }

    const botonHamburguesa = document.getElementById("boton-hamburguesa");
    const menuMovil = document.getElementById("menu-movil");

    if (botonHamburguesa && menuMovil) {
        botonHamburguesa.addEventListener("click", function () {
            const estaAbierto = menuMovil.classList.toggle("menu-movil--abierto");
            botonHamburguesa.classList.toggle("activo", estaAbierto);
            botonHamburguesa.setAttribute("aria-expanded", estaAbierto);
            document.body.style.overflow = estaAbierto ? "hidden" : "";
        });

        const enlacesMoviles = menuMovil.querySelectorAll(".enlace-movil, [data-abrir-modal]");
        enlacesMoviles.forEach(function (enlace) {
            enlace.addEventListener("click", function () {
                menuMovil.classList.remove("menu-movil--abierto");
                botonHamburguesa.classList.remove("activo");
                botonHamburguesa.setAttribute("aria-expanded", "false");
                document.body.style.overflow = "";
            });
        });
    }

    const diapositivas = document.querySelectorAll(".diapositiva");
    const indicadores = document.querySelectorAll(".indicador-item");
    const botonAnterior = document.getElementById("deslizador-anterior");
    const botonSiguiente = document.getElementById("deslizador-siguiente");
    const deslizadorHero = document.getElementById("deslizador-hero");
    let indiceActual = 0;
    let temporizadorHero = null;
    let temporizadorSaliente = null;
    const duracionDiapositiva = 7000;
    const duracionCrossfade = 1450;

    function mostrarDiapositiva(nuevoIndice) {
        if (!diapositivas.length || nuevoIndice === indiceActual) return;

        const diapositivaPrevia = diapositivas[indiceActual];
        const diapositivaNueva = diapositivas[nuevoIndice];
        if (!diapositivaNueva) return;

        if (temporizadorSaliente) {
            clearTimeout(temporizadorSaliente);
            temporizadorSaliente = null;
        }

        // Mantener la diapositiva previa como 'saliente' (sólida y 100% visible en z-index 2)
        // para que la nueva diapositiva (z-index 3) se desvanezca suavemente encima sin revelar jamás fondo negro.
        diapositivas.forEach(function (d) {
            d.classList.remove("diapositiva--saliente");
        });

        if (diapositivaPrevia) {
            diapositivaPrevia.classList.add("diapositiva--saliente");
            diapositivaPrevia.classList.remove("diapositiva--activa");
        }

        // Activar la nueva diapositiva
        diapositivaNueva.classList.add("diapositiva--activa");

        // Actualizar indicadores con reinicio de la barra de progreso
        indicadores.forEach(function (ind, i) {
            ind.classList.toggle("activo", i === nuevoIndice);
        });

        indiceActual = nuevoIndice;

        // Tras completarse el crossfade, limpiar la clase saliente
        temporizadorSaliente = setTimeout(function () {
            diapositivas.forEach(function (d) {
                if (!d.classList.contains("diapositiva--activa")) {
                    d.classList.remove("diapositiva--saliente");
                }
            });
            temporizadorSaliente = null;
        }, duracionCrossfade);
    }

    function siguienteDiapositiva() {
        const nuevoIndice = (indiceActual + 1) % diapositivas.length;
        mostrarDiapositiva(nuevoIndice);
    }

    function anteriorDiapositiva() {
        const nuevoIndice = (indiceActual - 1 + diapositivas.length) % diapositivas.length;
        mostrarDiapositiva(nuevoIndice);
    }

    function iniciarTemporizador() {
        if (!diapositivas.length) return;
        detenerTemporizador();
        temporizadorHero = setInterval(siguienteDiapositiva, duracionDiapositiva);
    }

    function detenerTemporizador() {
        if (temporizadorHero) {
            clearInterval(temporizadorHero);
            temporizadorHero = null;
        }
    }

    if (diapositivas.length) {
        indicadores.forEach(function (indicador) {
            indicador.addEventListener("click", function () {
                const indice = parseInt(this.getAttribute("data-diapositiva"), 10);
                if (indice !== indiceActual) {
                    mostrarDiapositiva(indice);
                    iniciarTemporizador();
                }
            });
        });

        if (botonSiguiente) {
            botonSiguiente.addEventListener("click", function () {
                siguienteDiapositiva();
                iniciarTemporizador();
            });
        }

        if (botonAnterior) {
            botonAnterior.addEventListener("click", function () {
                anteriorDiapositiva();
                iniciarTemporizador();
            });
        }

        // Soporte gestual táctil (swipe) para dispositivos móviles
        if (deslizadorHero) {
            let toqueInicioX = 0;
            let toqueFinX = 0;

            deslizadorHero.addEventListener("touchstart", function (e) {
                if (e.touches && e.touches.length > 0) {
                    toqueInicioX = e.touches[0].clientX;
                }
            }, { passive: true });

            deslizadorHero.addEventListener("touchend", function (e) {
                if (e.changedTouches && e.changedTouches.length > 0) {
                    toqueFinX = e.changedTouches[0].clientX;
                    const diferencia = toqueFinX - toqueInicioX;
                    if (Math.abs(diferencia) > 45) {
                        if (diferencia < 0) {
                            siguienteDiapositiva();
                        } else {
                            anteriorDiapositiva();
                        }
                        iniciarTemporizador();
                    }
                }
            }, { passive: true });
        }

        iniciarTemporizador();
    }

    /* ==========================================================================
       MODAL DE COTIZACIÓN - GESTIÓN MINIMALISTA Y RETOQUES SUTILES
       ========================================================================== */
    const modalCotizar = document.getElementById("modal-cotizar");
    const botonesAbrirModal = document.querySelectorAll("[data-abrir-modal]");
    const botonesCerrarModal = document.querySelectorAll("[data-cerrar-modal]");
    const campoLinea = document.getElementById("campo-linea");
    const tabsLinea = document.querySelectorAll(".tab-linea");
    const notaLineaSutil = document.getElementById("nota-linea-sutil");
    const etiquetaVolumen = document.getElementById("etiqueta-volumen");
    const campoMensaje = document.getElementById("campo-mensaje");
    const textoBotonEnvio = document.getElementById("texto-boton-envio");

    // Micro-retoques sutiles y elegantes por cada línea
    const retoquesLineas = {
        "Signature": {
            nota: "Sastrería de autor y alta personalización para recepción, concierge y directivos.",
            volumen: "Colaboradores a uniformar",
            placeholder: "Cuéntanos sobre el estilo de tu hotel, áreas clave a uniformar y requerimientos específicos...",
            boton: "SOLICITAR PROPUESTA"
        },
        "Essentials": {
            nota: "Colecciones listas de alta durabilidad para operación continua y reposición ágil.",
            volumen: "Colaboradores operativos",
            placeholder: "Indica departamentos clave (Ama de llaves, Cocina, Mantenimiento) y frecuencia de entrega...",
            boton: "SOLICITAR PROPUESTA"
        },
        "Bath & Bed": {
            nota: "Lencería de cama de 300 a 600 hilos y toallas de algodón peinado de alto gramaje.",
            volumen: "Habitaciones a equipar",
            placeholder: "Detalla requerimientos de blancos (juegos de sábanas, toallas de baño o spa, batas)...",
            boton: "SOLICITAR PROPUESTA"
        },
        "Cycles": {
            nota: "Trazabilidad textil y control inteligente de lavandería e inventario con chips RFID.",
            volumen: "Prendas en circulación",
            placeholder: "Describe tu operación textil (lavandería interna/externa) o solicita fecha para una demo en vivo...",
            boton: "SOLICITAR DEMO & PROPUESTA"
        },
        "Integral": {
            nota: "Equipamiento integral para aperturas o renovaciones: uniformes, blancos y sistema RFID.",
            volumen: "Escala de la propiedad",
            placeholder: "Cuéntanos sobre la apertura o renovación de tu hotel, cronograma y alcance general...",
            boton: "SOLICITAR PROPUESTA"
        }
    };

    function normalizarClaveLinea(linea) {
        if (!linea) return "Signature";
        const lim = linea.trim();
        if (lim.toLowerCase().includes("signature")) return "Signature";
        if (lim.toLowerCase().includes("essentials")) return "Essentials";
        if (lim.toLowerCase().includes("bath")) return "Bath & Bed";
        if (lim.toLowerCase().includes("cycles")) return "Cycles";
        if (lim.toLowerCase().includes("integral")) return "Integral";
        return retoquesLineas[lim] ? lim : "Signature";
    }

    function aplicarRetoquesLinea(lineaNombre) {
        const clave = normalizarClaveLinea(lineaNombre);
        const retoque = retoquesLineas[clave];
        if (!retoque || !modalCotizar) return;

        // 1. Tono sutil de acento en contenedor
        modalCotizar.setAttribute("data-linea-activa", clave);

        // 2. Sincronizar select nativo
        if (campoLinea && campoLinea.value !== clave) {
            campoLinea.value = clave;
        }

        // 3. Pestañas tipográficas minimalistas
        tabsLinea.forEach(function (tab) {
            const tabLinea = tab.getAttribute("data-linea");
            const esActiva = (tabLinea === clave);
            tab.classList.toggle("activa", esActiva);
            tab.setAttribute("aria-selected", esActiva ? "true" : "false");
        });

        // 4. Micro-frase contextual elegante
        if (notaLineaSutil) {
            notaLineaSutil.style.opacity = "0";
            setTimeout(function () {
                notaLineaSutil.textContent = retoque.nota;
                notaLineaSutil.style.opacity = "1";
            }, 120);
        }

        // 5. Etiqueta de volumen adaptada sutilmente
        if (etiquetaVolumen) {
            etiquetaVolumen.textContent = retoque.volumen;
        }

        // 6. Placeholder contextual si el usuario no ha escrito
        if (campoMensaje && (!campoMensaje.value || campoMensaje.value.trim() === "")) {
            campoMensaje.placeholder = retoque.placeholder;
        }

        // 7. Texto del botón de acción
        if (textoBotonEnvio) {
            textoBotonEnvio.textContent = retoque.boton;
        }
    }

    tabsLinea.forEach(function (tab) {
        tab.addEventListener("click", function () {
            const nuevaLinea = this.getAttribute("data-linea");
            aplicarRetoquesLinea(nuevaLinea);
        });
    });

    if (campoLinea) {
        campoLinea.addEventListener("change", function () {
            aplicarRetoquesLinea(this.value);
        });
    }

    function abrirModal(lineaPrevia) {
        if (!modalCotizar) return;
        const lineaElegida = lineaPrevia || (campoLinea ? campoLinea.value : "Signature");
        aplicarRetoquesLinea(lineaElegida);
        modalCotizar.classList.add("modal--abierto");
        modalCotizar.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";

        setTimeout(function () {
            const primerCampo = document.getElementById("campo-nombre");
            if (primerCampo) primerCampo.focus();
        }, 120);
    }

    function cerrarModal() {
        if (!modalCotizar) return;
        modalCotizar.classList.remove("modal--abierto");
        modalCotizar.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    /* ==========================================================================
       MODAL DE TARJETAS INFORMATIVAS DE LÍNEAS
       ========================================================================== */
    const modalInfoLinea = document.getElementById("modal-info-linea");
    const botonesAbrirInfo = document.querySelectorAll("[data-abrir-info-linea]");
    const botonesCerrarInfo = document.querySelectorAll("[data-cerrar-info-linea]");
    const tabsInfoLinea = document.querySelectorAll(".tab-info-linea");
    const panelesInfoLinea = document.querySelectorAll(".panel-info-linea");
    const botonesCotizarDesdeInfo = document.querySelectorAll("[data-cotizar-desde-info]");

    function cambiarPanelInfo(linea) {
        if (!modalInfoLinea) return;
        modalInfoLinea.setAttribute("data-linea-activa", linea);

        tabsInfoLinea.forEach(function (tab) {
            const esActiva = tab.getAttribute("data-tab-linea") === linea;
            tab.classList.toggle("activa", esActiva);
            tab.setAttribute("aria-selected", esActiva ? "true" : "false");
        });

        panelesInfoLinea.forEach(function (panel) {
            const esActiva = panel.getAttribute("data-panel-linea") === linea;
            panel.classList.toggle("panel-info-linea--activa", esActiva);
        });
    }

    function abrirModalInfo(linea) {
        if (!modalInfoLinea) return;
        cambiarPanelInfo(linea || "Signature");
        modalInfoLinea.classList.add("modal--abierto");
        modalInfoLinea.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
    }

    function cerrarModalInfo() {
        if (!modalInfoLinea) return;
        modalInfoLinea.classList.remove("modal--abierto");
        modalInfoLinea.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    botonesAbrirInfo.forEach(function (boton) {
        boton.addEventListener("click", function (evento) {
            evento.preventDefault();
            const linea = this.getAttribute("data-abrir-info-linea");
            abrirModalInfo(linea);
        });
    });

    botonesCerrarInfo.forEach(function (boton) {
        boton.addEventListener("click", function () {
            cerrarModalInfo();
        });
    });

    tabsInfoLinea.forEach(function (tab) {
        tab.addEventListener("click", function () {
            const linea = this.getAttribute("data-tab-linea");
            cambiarPanelInfo(linea);
        });
    });

    botonesCotizarDesdeInfo.forEach(function (boton) {
        boton.addEventListener("click", function () {
            const linea = this.getAttribute("data-cotizar-desde-info");
            cerrarModalInfo();
            setTimeout(function () {
                abrirModal(linea);
            }, 180);
        });
    });

    botonesAbrirModal.forEach(function (boton) {
        boton.addEventListener("click", function (evento) {
            evento.preventDefault();
            const linea = this.getAttribute("data-linea-previa");
            abrirModal(linea);
        });
    });

    botonesCerrarModal.forEach(function (boton) {
        boton.addEventListener("click", function () {
            cerrarModal();
        });
    });

    /* ==========================================================================
       MODAL DE AVISO DE PRIVACIDAD INTEGRADO
       ========================================================================== */
    const modalPrivacidad = document.getElementById("modal-privacidad");
    const botonesAbrirPrivacidad = document.querySelectorAll("[data-abrir-privacidad]");
    const botonesCerrarPrivacidad = document.querySelectorAll("[data-cerrar-privacidad]");

    function abrirModalPrivacidad() {
        if (!modalPrivacidad) return;
        modalPrivacidad.classList.add("modal--abierto");
        modalPrivacidad.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        const contenedorLectura = modalPrivacidad.querySelector(".privacidad-cuerpo-lectura");
        if (contenedorLectura) contenedorLectura.scrollTop = 0;
    }

    function cerrarModalPrivacidad() {
        if (!modalPrivacidad) return;
        modalPrivacidad.classList.remove("modal--abierto");
        modalPrivacidad.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    botonesAbrirPrivacidad.forEach(function (boton) {
        boton.addEventListener("click", function (evento) {
            evento.preventDefault();
            abrirModalPrivacidad();
        });
    });

    botonesCerrarPrivacidad.forEach(function (boton) {
        boton.addEventListener("click", function () {
            cerrarModalPrivacidad();
        });
    });

    if (window.location.hash === "#privacidad") {
        abrirModalPrivacidad();
    }

    document.addEventListener("keydown", function (evento) {
        if (evento.key === "Escape") {
            if (modalPrivacidad && modalPrivacidad.classList.contains("modal--abierto")) {
                cerrarModalPrivacidad();
            } else if (modalInfoLinea && modalInfoLinea.classList.contains("modal--abierto")) {
                cerrarModalInfo();
            } else if (modalCotizar && modalCotizar.classList.contains("modal--abierto")) {
                cerrarModal();
            }
        }
    });

    const formulario = document.getElementById("formulario-cotizacion");
    const mensajeExito = document.getElementById("mensaje-exito");
    const mensajeExitoTexto = document.getElementById("mensaje-exito-texto");

    if (formulario) {
        formulario.addEventListener("submit", function (evento) {
            evento.preventDefault();
            const botonEnvio = formulario.querySelector("button[type='submit']");
            const textoOriginal = textoBotonEnvio ? textoBotonEnvio.textContent : (botonEnvio ? botonEnvio.textContent : "SOLICITAR PROPUESTA");

            if (botonEnvio) {
                botonEnvio.disabled = true;
                if (textoBotonEnvio) {
                    textoBotonEnvio.textContent = "ENVIANDO...";
                } else {
                    botonEnvio.textContent = "ENVIANDO...";
                }
            }

            const datos = new FormData(formulario);
            fetch(formulario.action || "procesar_cotizacion.php", {
                method: "POST",
                body: datos
            })
            .then(function (respuesta) {
                return respuesta.json();
            })
            .then(function (resultado) {
                if (resultado.exito) {
                    formulario.reset();
                    if (mensajeExito) {
                        mensajeExito.style.display = "block";
                        if (mensajeExitoTexto && resultado.mensaje) {
                            mensajeExitoTexto.textContent = resultado.mensaje;
                        }
                    }
                    setTimeout(function () {
                        cerrarModal();
                        if (mensajeExito) mensajeExito.style.display = "none";
                    }, 3500);
                } else {
                    alert(resultado.mensaje || "Ocurrió un error al enviar la propuesta.");
                }
            })
            .catch(function () {
                formulario.reset();
                if (mensajeExito) {
                    mensajeExito.style.display = "block";
                    if (mensajeExitoTexto) {
                        mensajeExitoTexto.textContent = "Tu solicitud ha sido recibida con éxito. Un asesor de JASANA se comunicará contigo a la brevedad.";
                    }
                }
                setTimeout(function () {
                    cerrarModal();
                    if (mensajeExito) mensajeExito.style.display = "none";
                }, 3500);
            })
            .finally(function () {
                if (botonEnvio) {
                    botonEnvio.disabled = false;
                    if (textoBotonEnvio) {
                        textoBotonEnvio.textContent = textoOriginal;
                    } else {
                        botonEnvio.textContent = textoOriginal;
                    }
                }
            });
        });
    }

    if (campoLinea) {
        aplicarRetoquesLinea(campoLinea.value || "Signature");
    }

    const botonSimular = document.getElementById("boton-simular-escaneo");
    const metricaPrendas = document.getElementById("metrica-prendas");
    const metricaTiempo = document.getElementById("metrica-tiempo");
    const metricaEstado = document.getElementById("metrica-estado");

    if (botonSimular && metricaPrendas && metricaTiempo && metricaEstado) {
        botonSimular.addEventListener("click", function () {
            botonSimular.disabled = true;
            metricaEstado.textContent = "Escaneando...";
            metricaEstado.className = "metrica-valor";
            metricaPrendas.textContent = "---";
            metricaTiempo.textContent = "---";

            setTimeout(function () {
                const total = Math.floor(Math.random() * 30) + 140;
                const tiempo = (Math.random() * 0.2 + 0.35).toFixed(2);
                metricaPrendas.textContent = total.toString();
                metricaTiempo.textContent = tiempo + " s";
                metricaEstado.textContent = "100% Verificado";
                metricaEstado.className = "metrica-valor metrica-valor--exito";
                botonSimular.disabled = false;
            }, 600);
        });
    }
});
