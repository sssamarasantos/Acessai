using Acessai.Data.Context;
using Acessai.Domain.Interfaces.Repositories;
using Acessai.Domain.Models;
using Dommel;

namespace Acessai.Data.Repositories
{
    public class AulaRepository : IAulaRepository
    {
        private readonly DataContext _dataContext;

        public AulaRepository(DataContext dataContext)
        {
            _dataContext = dataContext;
        }

        public async Task<bool> ContemAulasAsync(long id)
        {
            using var conn = _dataContext.CreateConnection();

            return await conn.AnyAsync<Aula>(x => x.Id == id);
        }
    }
}
