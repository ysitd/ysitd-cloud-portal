export default function view(request, response, view, opts) {
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
