describe('template spec', () => {
  beforeEach(()=> {
    cy.login('Quincy17@Daniel.com','123456789')
  })

  it('can login', () => {
    cy.visit('/reserver');
    cy.get('#reservation_IdentifiantAbonnement').select('1')
    cy.get('#reservation_renouvellement').select('1')
    cy.get('button[type="submit"]').click();

    cy.url().should('include', '/reservations');
  })
})