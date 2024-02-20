using Acessai.Data.Context;
using Acessai.Domain.Interfaces.Repositories;
using Acessai.Domain.Models;
using Dommel;

namespace Acessai.Data.Repositories
{
    public class DisciplinaRepository : IDisciplinaRepository
    {
        private readonly DataContext _dataContext;

        public DisciplinaRepository(DataContext dataContext)
        {
            _dataContext = dataContext;
        }

        public async Task<IEnumerable<Disciplina>> BuscarAsync()
        {
            using var conn = _dataContext.CreateConnection();

            return await conn.GetAllAsync<Disciplina>();
        }
    }
}
