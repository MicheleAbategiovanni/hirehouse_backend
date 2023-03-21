@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <form method="POST" action="{{ route('admin.apartments.store') }}" class="row g-3 needs-validation"
        enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Titolo --}}
        <div class="col-md-6">
            <label for="inputTitle" class="form-label ">Nome Immobile*</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle" name="title"
                required minlength="8">
            <div class="invalid-feedback">
                Il campo è obbligatorio e deve avere almeno 8 caratteri
            </div>

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Immagine --}}
        <div class="col-md-3">
            <label for="cover_img" class="form-label">Immagine appartamento</label>
            <input type="file" class="form-control @error('cover_img') is-invalid @enderror" name="cover_img">

            @error('cover_img')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Prezzo --}}
        <div class="col-md-3">
            <label for="inputPrice" class="form-label">Prezzo*</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="inputPrice" name="price"
                required step=".01">
            <div class="invalid-feedback">
                Il campo è obbligatorio
            </div>

            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Indirizzo --}}
        <div class="col-12 mb-3">
            <div class="d-flex">
                <label for="full_address" class="form-label flex-basis20">Indirizzo completo*</label>
                <div class="invalid-feedback mb-2" id="errorAddres">
                    Il campo è obbligatorio
                </div>

            </div>
            @error('full_address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="map-view-container">
                <div class='map-view'>
                    <div class='tt-side-panel'>
                        <header class='tt-side-panel__header'>
                        </header>
                        <div class='tt-tabs js-tabs'>
                            <div class='tt-tabs__panel'>
                                <div class='js-results' hidden='hidden'></div>
                                <div class='js-results-loader' hidden='hidden'>
                                    <div class='loader-center'><span class='loader'></span></div>
                                </div>
                                <div class='tt-tabs__placeholder js-results-placeholder'></div>
                            </div>
                        </div>
                    </div>
                    <div id='map' class='full-map '></div>
                </div>
            </div>
        </div>

        {{-- Descrizione --}}
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control @error('description') is-invalid @enderror"
                    placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                    name="description" required></textarea>
                    <div class="invalid-feedback">
                        Campo richiesto
                    </div>

                <label for="floatingTextarea2">Descrizione*</label>


                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- Numero stanze --}}
        <div class="col-md-3">
            <label for="inputRomms" class="form-label">Numero stanze*</label>
            <input type="number" class="form-control @error('num_rooms') is-invalid @enderror" id="inputRooms"
                name="num_rooms" min="0" required>
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('num_rooms')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Numero bagni --}}
        <div class="col-md-3">
            <label for="inputBathrooms" class="form-label">Numero bagni*</label>
            <input type="number" class="form-control @error('num_bathrooms') is-invalid @enderror" id="inputBathrooms"
                name="num_bathrooms" min="0" required>
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('num_bathrooms')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Numero letti --}}
        <div class="col-md-3">
            <label for="inputBeds" class="form-label">Numero letti*</label>
            <input type="number" class="form-control @error('num_beds') is-invalid @enderror" id="inputBeds"
                name="num_beds" min="0" required>
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('num_beds')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Metri quadri --}}
        <div class="col-md-3">
            <label for="inputSquareMeters" class="form-label">Metri quadri*</label>
            <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                id="inputSquareMeters" name="square_meters" min="0" required>
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('square_meters')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Check-in --}}
        <div class="col-md-3">
            <label for="inputPassword4" class="form-label">Check-in*</label>
            <input type="time" class="form-control @error('check_in') is-invalid @enderror" id="inputPassword4"
                placeholder="10:00" name="check_in" required>

            @error('check_in')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Check-out --}}
        <div class="col-md-3">
            <label for="inputPassword4" class="form-label">Check-out*</label>
            <input type="time" class="form-control @error('check_out') is-invalid @enderror" id="inputPassword4"
                placeholder="18:00" name="check_out" required>

            @error('check_out')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Vuota --}}
        <div class="col-md-6">

        </div>

        {{-- Visibilità --}}
        <div class="col-md-3">
            <div class="form-switch">
                <input type="hidden" name="visibile" value="0">
                <input type="checkbox" class="form-check-input" value="1" name="visibile">
                <label class="form-check-label" for="gridCheck"> Visibilità </label>

                @error('visibile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Regole
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            @foreach ($rules as $rule)
                            <div class="form-check form-check @error('rules') is-invalid @enderror">

                                <input class="form-check-input @error('rules') is-invalid @enderror" type="checkbox"
                                    id="ruleCheckbox_{{ $loop->index }}" value="{{ $rule->id }}" name="rules[]" {{
                                    in_array($rule->id, old('rules', [])) ? 'checked' : '' }}>

                                <i class="fa-solid {{ $rule->icon }}"></i>
                                <label class="form-check-label" for="ruleCheckbox_{{ $loop->index }}">{{ $rule->name
                                    }}</label>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span id="textServices"> Servizi*</span> <span class="d-none text-danger"
                                id="errorServices">Seleziona almeno un servizio</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($services as $service)
                            <div class="form-check form-check @error('services') is-invalid @enderror">

                                <input class="form-check-input servicesCheck @error('services') is-invalid @enderror"
                                    type="checkbox" id="servicesCheckbox_{{ $loop->index }}" value="{{ $service->id }}"
                                    name="services[]" {{ in_array($service->id, old('services', [])) ? 'checked' : ''
                                }}>

                                <i class="fa-solid {{ $service->icon }}"></i>
                                <label class="form-check-label" for="servicesCheckbox_{{ $loop->index }}">{{
                                    $service->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-12 pb-4 text-center">
            <button class="btn my-btn-turchese w-25">
                <i class="fa-solid fa-plus"></i>
                Pubblica
            </button>
        </div>

    </form>

</div>


<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/maps/maps-web.min.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.23.0/services/services-web.min.js"></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.2.0//SearchBox-web.js"></script>
<script
    src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/search-markers/search-marker.js">
</script>
<script
    src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/search/search-results-parser.js">
</script>
<script
    src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/search-markers/search-markers-manager.js">
</script>
<script src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/info-hint.js">
</script>
<script src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/mobile-or-tablet.js">
</script>
<script
    src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/search/results-manager.js">
</script>
<script
    src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/search/side-panel.js">
</script>
<script
    src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/search/dom-helpers.js">
</script>
<script src="https://api.tomtom.com/maps-sdk-for-web/6.x/6.23.0//examples/pages/examples/assets/js/formatters.js">
</script>

<script>
    var map = tt.map({
        key: '6hakT8QU7IRSx9PCHGi5JyHTV2S7xWlD',
        container: 'map',
        center: [ 12.4963655, 41.9027835],
        zoom: 6,
        language: 'it-IT'
      
    });
    var infoHint = new InfoHint('info', 'bottom-center', 5000).addTo(document.getElementById('map'));
    var errorHint = new InfoHint('error', 'bottom-center', 5000).addTo(document.getElementById('map'));
    // Options for the fuzzySearch service
    var searchOptions = {
        key: '6hakT8QU7IRSx9PCHGi5JyHTV2S7xWlD',
        language:'it-IT',
        limit: 8
    };
    // Options for the autocomplete service
    var autocompleteOptions = {
        key: '6hakT8QU7IRSx9PCHGi5JyHTV2S7xWlD',
        language: 'it-IT'
    };
    var searchBoxOptions = {
        minNumberOfCharacters: 0,
        searchOptions: searchOptions,
        autocompleteOptions: autocompleteOptions,
        distanceFromPoint: [15.4, 53.0]
    };
    var ttSearchBox = new tt.plugins.SearchBox(tt.services, searchBoxOptions);
    document.querySelector('.tt-side-panel__header').appendChild(ttSearchBox.getSearchBoxHTML());
    var state = {
        previousOptions: {
            query: null,
            center: null
        },
        callbackId: null,
        userLocation: null
    };
    // map.addControl(new tt.FullscreenControl({container: document.querySelector('body')}));
    map.addControl(new tt.NavigationControl());
    new SidePanel('.tt-side-panel', map);
    var geolocateControl = new tt.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: false
        }
    });
    geolocateControl.on('geolocate', function(event) {
        var coordinates = event.coords;
        state.userLocation = [coordinates.longitude, coordinates.latitude];
        ttSearchBox.updateOptions(Object.assign({}, ttSearchBox.getOptions(), {
            distanceFromPoint: state.userLocation
        }));
    });
    map.addControl(geolocateControl);
    var resultsManager = new ResultsManager();
    var searchMarkersManager = new SearchMarkersManager(map);
    map.on('load', handleMapEvent);
    map.on('moveend', handleMapEvent);
    ttSearchBox.on('tomtom.searchbox.resultscleared', handleResultsCleared);
    ttSearchBox.on('tomtom.searchbox.resultsfound', handleResultsFound);
    ttSearchBox.on('tomtom.searchbox.resultfocused', handleResultSelection);
    ttSearchBox.on('tomtom.searchbox.resultselected', handleResultSelection);
    function handleMapEvent() {
        // Update search options to provide geobiasing based on current map center
        var oldSearchOptions = ttSearchBox.getOptions().searchOptions;
        var oldautocompleteOptions = ttSearchBox.getOptions().autocompleteOptions;
        var newSearchOptions = Object.assign({}, oldSearchOptions, { center: map.getCenter() });
        var newAutocompleteOptions = Object.assign({}, oldautocompleteOptions, { center: map.getCenter() });
        ttSearchBox.updateOptions(Object.assign({}, searchBoxOptions, {
            placeholder: 'Inserisci il tuo indirizzo',
            searchOptions: newSearchOptions,
            autocompleteOptions: newAutocompleteOptions,
            distanceFromPoint: state.userLocation
        }));
    }
    function handleResultsCleared() {
        searchMarkersManager.clear();
        resultsManager.clear();
    }
    function handleResultsFound(event) {
        // Display fuzzySearch results if request was triggered by pressing enter
        if (event.data.results && event.data.results.fuzzySearch && event.data.metadata.triggeredBy === 'submit') {
            var results = event.data.results.fuzzySearch.results;
            if (results.length === 0) {
                handleNoResults();
            }
            searchMarkersManager.draw(results);
            resultsManager.success();
            fillResultsList(results);
            fitToViewport(results);
        }
        if (event.data.errors) {
            errorHint.setMessage('There was an error returned by the service.');
        }
    }
    function handleResultSelection(event) {
        if (isFuzzySearchResult(event)) {
            // Display selected result on the map
            var result = event.data.result;
            resultsManager.success();
            searchMarkersManager.draw([result]);
            fillResultsList([result]);
            searchMarkersManager.openPopup(result.id);
            fitToViewport(result);
            state.callbackId = null;
            infoHint.hide();
        } else if (stateChangedSinceLastCall(event)) {
            var currentCallbackId = Math.random().toString(36).substring(2, 9);
            state.callbackId = currentCallbackId;
            // Make fuzzySearch call with selected autocomplete result as filter
            handleFuzzyCallForSegment(event, currentCallbackId);
        }
    }
    function isFuzzySearchResult(event) {
        return !('matches' in event.data.result);
    }
    function stateChangedSinceLastCall(event) {
        return Object.keys(searchMarkersManager.getMarkers()).length === 0 || !(
            state.previousOptions.query === event.data.result.value &&
            state.previousOptions.center.toString() === map.getCenter().toString());
    }
    function getBounds(data) {
        var southWest;
        var northEast;
        if (data.viewport) {
            southWest = [data.viewport.topLeftPoint.lng, data.viewport.btmRightPoint.lat];
            northEast = [data.viewport.btmRightPoint.lng, data.viewport.topLeftPoint.lat];
        }
        return [southWest, northEast];
    }
    function fitToViewport(markerData) {
        if (!markerData || markerData instanceof Array && !markerData.length) {
            return;
        }
        var bounds = new tt.LngLatBounds();
        if (markerData instanceof Array) {
            markerData.forEach(function(marker) {
                bounds.extend(getBounds(marker));
            });
        } else {
            bounds.extend(getBounds(markerData));
        }
        map.fitBounds(bounds, { padding: 100, linear: true });
    }
    function handleFuzzyCallForSegment(event, currentCallbackId) {
        var query = ttSearchBox.getValue();
        var segmentType = event.data.result.type;
        var commonOptions = Object.assign({}, searchOptions, {
            query: query,
            limit: 15,
            center: map.getCenter(),
            typeahead: true,
            language: 'en-GB'
        });
        var filter;
        if (segmentType === 'category') {
            filter = { categorySet: event.data.result.id };
        }
        if (segmentType === 'brand') {
            filter = { brandSet: event.data.result.value };
        }
        var options = Object.assign({}, commonOptions, filter);
        infoHint.setMessage('Loading results...');
        errorHint.hide();
        resultsManager.loading();
        tt.services.fuzzySearch(options)
            .then(function(response) {
                if (state.callbackId !== currentCallbackId) {
                    return;
                }
                if (response.results.length === 0) {
                    handleNoResults();
                    return;
                }
                resultsManager.success();
                searchMarkersManager.draw(response.results);
                fillResultsList(response.results);
                map.once('moveend', function() {
                    state.previousOptions = {
                        query: query,
                        center: map.getCenter()
                    };
                });
                fitToViewport(response.results);
            })
            .catch(function(error) {
                if (error.data && error.data.errorText) {
                    errorHint.setMessage(error.data.errorText);
                }
                resultsManager.resultsNotFound();
            })
            .finally(function() {
                infoHint.hide();
            });
    }
    function handleNoResults() {
        resultsManager.clear();
        resultsManager.resultsNotFound();
        searchMarkersManager.clear();
        infoHint.setMessage(
            'No results for "' +
            ttSearchBox.getValue() +
            '" found nearby. Try changing the viewport.'
        );
    }
    function fillResultsList(results) {
        resultsManager.clear();
        var resultList = DomHelpers.createResultList();
        results.forEach(function(result) {
            var distance = state.userLocation ? SearchResultsParser.getResultDistance(result) : undefined;
            var addressLines = SearchResultsParser.getAddressLines(result);
            var searchResult = this.DomHelpers.createSearchResult(
                addressLines[0],
                addressLines[1],
                distance ? Formatters.formatAsMetricDistance(distance) : ''
            );
            var resultItem = DomHelpers.createResultItem();
            resultItem.appendChild(searchResult);
            resultItem.setAttribute('data-id', result.id);
            resultItem.onclick = function(event) {
                var id = event.currentTarget.getAttribute('data-id');
                searchMarkersManager.openPopup(id);
                searchMarkersManager.jumpToMarker(id);
            };
            resultList.appendChild(resultItem);
        });
        resultsManager.append(resultList);
    }




    const address = document.querySelector('.tt-search-box-input');
    const errorAddressHTML=document.querySelector("#errorAddres");
    
    
    address.setAttribute("required","");
    
    address.setAttribute('id', 'full_address');
    address.setAttribute('name', 'full_address');


    // Validazione delle regole !
    const forms = document.querySelectorAll('.needs-validation')
            let erroreMess=document.querySelector("#errorServices")
            let textServ=document.querySelector("#textServices")
            
            
            
            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }
            let servicesList = [];
            Array.from(document.querySelectorAll(".servicesCheck")).forEach(function(inp) {
            if (inp.checked === true) {
            servicesList.push(inp)
            }
            });
            if(servicesList.length===0){
            event.preventDefault()
            event.stopPropagation()
            erroreMess.classList.remove("d-none")
            textServ.classList.add("d-none")
            }
            if(address.value ==""){
                event.preventDefault()
            event.stopPropagation()
            errorAddressHTML.classList.add("d-block")
            
            address.classList.add("is-invalid");
            console.log("non hai inserito indirizzo")
            erroreMess.classList.remove("d-none")
            textServ.classList.add("d-none")

            }
            
            form.classList.add('was-validated')
            }, false)
            })
</script>
@endsection