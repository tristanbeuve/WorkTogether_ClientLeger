describe('template spec', () => {
  beforeEach(()=> {
    cy.visit('http://15.237.128.236:80');
  })

  it('can login', () => {
    cy.visit('http://15.237.128.236:80/login');
    cy.get('#username').type('admin@admin.com')
    cy.get('#password').type('vv83Bd^Jo!!6h^m%Lbn5')
    cy.get('button[type="submit"]').click();
    cy.url().should('include', 'http://15.237.128.236');
  })
})