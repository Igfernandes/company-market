// a polyfill for it would be:
AbortSignal.timeout = function timeout(ms) {
  const ctrl = new AbortController();
  setTimeout(() => ctrl.abort(), ms);
  return ctrl.signal;
};

export const AbortSignalConfig = AbortSignal;
