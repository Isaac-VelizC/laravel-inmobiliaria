<!-- Modal Mapa -->
<div class="modal fade" id="modalMapa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel4">Mapa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Para seleccionar una ubicación, hacer clic cuando ubique la Propiedad</p>
                <div id="map" style="height: 500px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ciudades = @json($ciudades); 
        let map, marker;
        const defaultCoords = { lat: -19.589277, lng: -65.753506 };
        let cityMarkers = [];

        // Definir un ícono personalizado para la selección de ubicación
        const customIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/18751/18751801.png',  // Ruta de tu imagen
            iconSize: [40, 40], // Tamaño del ícono
            iconAnchor: [20, 40], // Punto del ícono que se coloca en la coordenada
            popupAnchor: [0, -40] // Ajustar la posición del popup
        });
        
        const cityIcon = L.icon({
            iconUrl: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            iconSize: [32, 32],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });

        function inicializarMapa() {
            map = L.map('map').setView([defaultCoords.lat, defaultCoords.lng], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: 'Soluciones Inmobiliarias'
            }).addTo(map);

            marker = L.marker([defaultCoords.lat, defaultCoords.lng], {
                icon: customIcon,
                draggable: true
            }).addTo(map);

            marker.on('dragend', function () {
                const { lat, lng } = marker.getLatLng();
                actualizarInputs(lat, lng);
            });

            map.on('click', function (e) {
                moverMarcador(e.latlng.lat, e.latlng.lng);
            });

            agregarMarcadoresCiudades();
        }

        function agregarMarcadoresCiudades() {
            cityMarkers.forEach(m => map.removeLayer(m));
            cityMarkers = [];

            for (const key in ciudades) {
                if (ciudades.hasOwnProperty(key)) {
                    const { latitud, longitud } = ciudades[key].coordenadas;
                    const cityMarker = L.marker([latitud, longitud], {
                        icon: cityIcon,
                    }).addTo(map)
                        .bindPopup(`<b>${ciudades[key].nombre}</b><br>Haz clic para acercarte.`);

                    cityMarker.on('click', function () {
                        acercarACiudad(latitud, longitud);
                    });

                    cityMarkers.push(cityMarker);
                }
            }
        }

        function acercarACiudad(lat, lng) {
            map.setView([lat, lng], 14);
            moverMarcador(lat, lng);
        }

        function moverMarcador(lat, lng) {
            marker.setLatLng([lat, lng]).bindPopup('Ubicación seleccionada').openPopup();
            actualizarInputs(lat, lng);
        }

        function actualizarInputs(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        }

        document.getElementById('modalMapa').addEventListener('shown.bs.modal', function () {
            if (!map) {
                inicializarMapa();
            } else {
                map.invalidateSize();
            }
        });

        document.getElementById('ciudad').addEventListener('change', function () {
            const ciudadSeleccionada = this.value;
            if (ciudadSeleccionada in ciudades) {
                const { latitud, longitud } = ciudades[ciudadSeleccionada].coordenadas;
                acercarACiudad(latitud, longitud);
            }
        });
    });

    function abrirMapa() {
        $('#modalMapa').modal('show');
    }
</script>

