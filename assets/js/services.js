
vetoApp.service('pathService', function() {
    this.path = 'join';
});

vetoApp.service('vetoService', ['$resource', function($resource) {
    this.GetVeto = function() {
        var vetoAPI = $resource("http://localhost/mcspro/veto/api/getveto", { callback: 'JSON_CALLBACK'}, { get: { method: 'JSONP'} } );
        return vetoAPI.get();
    }
}]);

vetoApp.service('vetoMapService', ['$resource', function($resource) {
    this.GetVetoMaps = function() {
        var vetoAPI = $resource("http://localhost/mcspro/veto/api/getmappool/", { callback: 'JSON_CALLBACK'}, { get: { method:'GET', isArray:true } } );
        return vetoAPI.get();
    }
}]);