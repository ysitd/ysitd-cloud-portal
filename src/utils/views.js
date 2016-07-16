const defaultView = {
  username: 'foo',
  logo: '/images/user.png',
  nodes: [
    {id: 'hkg-1', name: 'HKG - 1'}
  ]
};

export default function view(response, view, opts) {
  const local = Object.assign({}, defaultView, opts);
  response.render(view, local);
}
