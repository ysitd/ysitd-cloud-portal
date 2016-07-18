export default function view(request, response, view, opts) {
  response.set('Link', [
    '</css/portal.min.css>; rel=preload; as=style',
    '</js/vendor.min.js>; rel=preload; as=script',
    '</js/app.min.js>; rel=preload; as=script',
    '</images/cloud.svg>; rel=preload; as=image'
  ]);
  const local = Object.assign({}, opts);
  if (request.session) {
    local.session = request.session;
    if ('roles' in request.session) {
      local.roles = request.session.roles;
    }

    if ('root' in request.session) {
      local.root = request.session.root;
    }
  }
  response.render(view, local);
}
