using Acessai.Domain.Models;

namespace Acessai.Domain.Interfaces.Repositories
{
    public interface IDisciplinaRepository
    {
        Task<IEnumerable<Disciplina>> BuscarAsync();
    }
}
