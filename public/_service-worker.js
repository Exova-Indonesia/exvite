var _0x9928 = [
    "Exova",
    "/",
    "install",
    "skipWaiting",
    "then",
    "addAll",
    "open",
    "waitUntil",
    "addEventListener",
    "fetch",
    "request",
    "match",
    "respondWith",
    "activate",
    "claim",
    "clients",
];
var CACHE_NAME = _0x9928[0];
var REQUIRED_FILES = [_0x9928[1]];
self[_0x9928[8]](_0x9928[2], function (_0xd6c5x3) {
    _0xd6c5x3[_0x9928[7]](
        caches[_0x9928[6]](CACHE_NAME)
            [_0x9928[4]](function (_0xd6c5x4) {
                return _0xd6c5x4[_0x9928[5]](REQUIRED_FILES);
            })
            [_0x9928[4]](function () {
                return self[_0x9928[3]]();
            })
    );
});
self[_0x9928[8]](_0x9928[9], function (_0xd6c5x3) {
    _0xd6c5x3[_0x9928[12]](
        caches[_0x9928[11]](_0xd6c5x3[_0x9928[10]])[_0x9928[4]](function (
            _0xd6c5x5
        ) {
            if (_0xd6c5x5) {
                return _0xd6c5x5;
            }
            return fetch(_0xd6c5x3[_0x9928[10]]);
        })
    );
});
self[_0x9928[8]](_0x9928[13], function (_0xd6c5x3) {
    _0xd6c5x3[_0x9928[7]](self[_0x9928[15]][_0x9928[14]]());
});
