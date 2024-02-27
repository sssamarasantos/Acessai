using Acessai.Domain.Interfaces.Services;
using Microsoft.AspNetCore.Mvc;
using System.ComponentModel.DataAnnotations;

namespace Acessai.Api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AulaController : ControllerBase
    {
        private readonly IAulaService _aulaService;

        public AulaController(IAulaService aulaService)
        {
            _aulaService = aulaService;
        }

        [HttpGet("Verificar/{id}")]
        public async Task<IActionResult> GetEmail([FromRoute][Required] long id)
        {
            var response = await _aulaService.ContemAulasAsync(id);

            return Ok(response);
        }
    }
}
